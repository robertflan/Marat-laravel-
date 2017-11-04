<div class="row">
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
            <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' form-control-danger' : '' }}" value="{{ old('title')?: $questionnaire->title }}" placeholder="Title">
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
            <textarea rows="1" name="description" class="form-control{{ $errors->has('description') ? ' form-control-danger' : '' }}"  placeholder="Description">{{ old('description')?: $questionnaire->description }}</textarea>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
            <select name="status" class="form-control select2" data-placeholder="Select a status">
                <option></option>
                @foreach(config('enums.status') as $status)
                    <option value="{{ $status }}" {{old('status') == $status ? 'selected' : 
                    ($questionnaire->status == $status ? 'selected' : '')}}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<hr>
<h3>Questions</h3>
<div class="row">
    @if($count = count(old('question_titles')?? $questionnaire->questions))
        @for($i = 0; $i < $count; $i++)
        @php
            $hasQ = false;
            if(count($questionnaire->questions) && isset($questionnaire->questions[$i]))
                $hasQ = true;
        @endphp

            <div class="question-block user-wall-item clearfix">
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('question_titles.'.$i) ? ' has-danger' : '' }}">
                        <input type="text" name="question_titles[]" 
                        class="form-control{{ $errors->has('question_titles.'.$i) ? ' form-control-danger' : '' }}" 
                        value="{{old('question_titles')[$i]?: 
                        ($hasQ ? $questionnaire->questions[$i]->question_title : '')  }}" placeholder="Question">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('types.'.$i) ? ' has-danger' : '' }}">
                        <select name="types[]" class="form-control select-type select2" data-placeholder="Select a type">
                            <option></option>
                            <option value="text" {{old('types') && old('types')[$i] == 'text' ? 'selected' : 
                            ($hasQ && $questionnaire->questions[$i]->type == 'text' ? 'selected' : '')}}>Text</option>
                            <option value="textarea" {{old('types') && old('types')[$i] == 'textarea' ? 'selected' : 
                            ($hasQ && $questionnaire->questions[$i]->type == 'textarea' ? 'selected' : '')}}>Textarea</option>
                            <option value="radio" {{old('types') && old('types')[$i] == 'radio' ? 'selected' : 
                            ($hasQ && $questionnaire->questions[$i]->type == 'radio' ? 'selected' : '')}}>Radio</option>
                            <option value="dropdown" {{old('types') && old('types')[$i] == 'dropdown' ? 'selected' : 
                            ($hasQ && $questionnaire->questions[$i]->type == 'dropdown' ? 'selected' : '')}}>Dropdown</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group{{ $errors->has('options.'.$i) ? ' has-danger' : '' }}">
                        <textarea rows="2" name="options[]" class="form-control options {{ $errors->has('options.'.$i) ? 'form-control-danger ' : ''}}
                        {{old('types')[$i] == 'dropdown' || ($hasQ && ($questionnaire->questions[$i]->type == 'dropdown' || $questionnaire->questions[$i]->type == 'radio')) ? 
                        'shown' : 'hidden' }}"  placeholder="Add an option">{{ old('options')[$i] ?? 
                        ($hasQ ? implode(',', $questionnaire->questions[$i]->options) : '') }}</textarea>
                    </div>

                    @if($i >= 1)
                        <a href="javascript:void(0)" class="remove text-danger pull-right">Remove</a>
                    @endif
                </div>
                <div class="divider-center"></div>
            </div>
        @endfor
    @else
        <div class="question-block user-wall-item clearfix">
            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('question_titles') ? ' has-danger' : '' }}">
                    <input type="text" name="question_titles[]" class="form-control{{ $errors->has('question_titles') ? ' form-control-danger' : '' }}" placeholder="Question">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <select name="types[]" class="form-control select-type select2" data-placeholder="Select a type">
                        <option></option>
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="radio">Radio</option>
                        <option value="dropdown">Dropdown</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <textarea rows="2" name="options[]" class="form-control hidden options"  placeholder="Add an option"></textarea>
                </div>
            </div>
            <div class="divider-center"></div>
        </div>
    @endif
</div>

<a href="javascript:void(0)" class="add-more pull-right">Add More +</a>


@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset('assets/jqtags/jquery.tag-editor.css')}}">
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js"></script>
<script type="text/javascript" src="{{asset('assets/jqtags/jquery.caret.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/jqtags/jquery.tag-editor.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $select2 = $('.select2').select2({
        allowClear: true,
        width: '100%',
    });

    $('textarea[name="options[]"].shown').tagEditor({
        placeholder: 'Add an option',
        forceLowercase: false
    });

    $('.add-more').on('click', function(){        
        var questionblock = $('.question-block').first();
        questionblock.find('.select-type').select2('destroy');
        var clone = questionblock.clone();
        clone.find('input').val('');
        clone.find('.options, .select2').val('');
        clone.find('.options').hide();
        clone.find('.options').tagEditor('destroy');
        clone.find('.col-lg-12').append('<a href="javascript:void(0)" class="remove text-danger pull-right">Remove</a>');
        questionblock.parent().append(clone);

        $('.select2').select2({
            allowClear: true,
            width: '100%',
        });
    });

    $('body').on('click', 'a.remove', function(){
        $(this).closest('.question-block').remove();
    });

    $('body').on('change', '.select-type', function(){
        var questionblock = $(this).closest('.question-block');
        questionblock.find('.options').hide();
        questionblock.find('.options').val('');
        questionblock.find('.options').tagEditor('destroy');

        if(this.value == 'dropdown' || this.value == 'radio'){
            questionblock.find('.options').tagEditor({
                placeholder: 'Add an option',
                forceLowercase: false
            });
        }
    });
});
</script>
@endpush