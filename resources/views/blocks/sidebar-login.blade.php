@component('components.sidebar')
	@slot('title') Don't have an account? @endslot

	<ul>
        <li><p>If you'd like to find out more about how Jobsite can help you with your recruitment needs, please complete this enquiry form.</p></li>
        <li><p>A member of our Sales team will contact you shortly.</p></li>
        <li><a href="{{ url('/register') }}" class="label job-type register" id="register">Register</a></li>
    </ul>
@endcomponent