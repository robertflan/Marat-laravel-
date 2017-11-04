window.Vue = require('vue');
import moment from 'moment';
import messages from 'vee-validate/dist/locale/de';
import VeeValidate, { Validator } from 'vee-validate';

Validator.addLocale(messages);
Validator.installDateTimeValidators(moment);

const config = {
  // errorBagName: 'errors', // change if property conflicts.
  // fieldsBagName: 'fields',
  // delay: 0,
  // dictionary: null,
  // strict: true,
  // enableAutoClasses: false,
  // classNames: {
  //   touched: 'touched', // the control has been blurred
  //   untouched: 'untouched', // the control hasn't been blurred
  //   valid: 'valid', // model is valid
  //   invalid: 'invalid', // model is invalid
  //   pristine: 'pristine', // control has not been interacted with
  //   dirty: 'dirty' // control has been interacted with
  // },
  // events: 'input|blur',
  // inject: true,
  locale: 'de'
};

Vue.use(VeeValidate, config);

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.component('execute', require('./components/execute.vue'));

const app = new Vue({
    el: '#app',
    data: {
        register: {
            gender: null
        },
        search: {
        	type: [],
        	location: null,
        	location_name: null,
        	category: null,
        	category_name: null,
        	search_text: null,
        	nothing_found: false,
        	activePopular: 'all'
        },
        application: {
        	qualification: [
        		{
        			id: 1,
        			qual: ''
        		}
        	],
        	language: [
        		{
        			id: 1,
        			lang: '',
        			level: ''
        		}
        	],
        	self_destroy: 0
        },
        jobs: [],
        modal: false,
        validateErrors: false,
        email : null,
        email_error: false
    },
    methods: {
        validateEmail: function() {
            var self = this;

            axios.post('/api/validate/email', {
                email: this.email
            }).then(function (response) {
                if(response.data.error) {
                    self.email_error = true;
                } else {
                    self.email_error = false;
                }
            }).catch(function (error) {
                console.log(error);
            });
        },
    	validateApplication: function() {
    		var self = this;

            if(!this.email_error) {
        		this.$validator.validateAll().then(result => {
    		        if (result) {
    		        	//self.modal = true;
    		        	document.getElementById('form-style-2').submit();
    		        	self.validateErrors = false;
    		        } else {
    		        	self.validateErrors = true;
    		        }
    		    });
            } else {
                this.validateErrors = true;
            }
    	},
    	submitApplication: function(param) {
    		this.self_destroy = param;
    		this.modal = false;
    		document.getElementById('form-style-2').submit();
    	},
    	submitSearch: function() {
    		var self = this;

            axios.post('/api/search', {
            	type: this.search.type,
                location: this.search.location,
                category: this.search.category,
                search_text: this.search.search_text
            }).then(function (response) {
            	console.log(response);

            	if(response.data && !self.jobs.length) {
            		document.getElementById('job-items').innerHTML = '';
            		console.log('destroyed');
            	}

            	if(!response.data.length) {
            		self.search.nothing_found = true;
            	} else {
            		self.search.nothing_found = false;
            	}

                self.jobs = response.data;
            }).catch(function (error) {
                console.log(error);
            });
    	},
    	filterCategory: function(category) {
    		var self = this;

    		this.search.activePopular = category;

            axios.post('/api/search', {
                category: category
            }).then(function (response) {
            	console.log(response);

            	if(response.data && !self.jobs.length) {
            		document.getElementById('job-items').innerHTML = '';
            		console.log('destroyed');
            	}

            	if(!response.data.length) {
            		self.search.nothing_found = true;
            	} else {
            		self.search.nothing_found = false;
            	}

                self.jobs = response.data;
            }).catch(function (error) {
                console.log(error);
            });
    	}
    }
});
