<div class="modal fade in" id="modal-{{$questionnaire->status}}" role="dialog" aria-labelledby="" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">{{$questionnaire->title}}</h4>
            </div>
            <form class="questionnaire-form" method="POST" action="{{route('questionnaire.answers', ['questionnaire' => $questionnaire->id, 'application' => $application->id])}}">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        @php
                            $answers = $application->answers()->where('questionnaire_id', $questionnaire->id)->first();
                            $json = $answers ? $answers->json : [];
                        @endphp
                        @foreach($questionnaire->questions as  $question)
                            <label>{{$question->question_title}}</label>

                            @if($question->type == 'text')
                            
                            <input type="text" name="json[{{$question->question_title}}]" class="form-control" placeholder="Answer"
                            value="{{@$json[$question->question_title]}}">
                            
                            @elseif($question->type == 'textarea')
                            
                            <textarea rows="1" name="json[{{$question->question_title}}]" class="form-control" 
                            placeholder="Answer">{{@$json[$question->question_title]}}</textarea> 
                            
                            @elseif($question->type == 'radio')
                                <div class="form-group radio-block">
                                    @foreach($question->options as $option)
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="json[{{$question->question_title}}]" value="{{$option}}" 
                                            {{@$json[$question->question_title] == $option ? 'checked' : ''}}>
                                            {{$option}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            @elseif($question->type == 'dropdown')
                            
                                <select name="json[{{$question->question_title}}][]" class="form-control select-type select2" multiple 
                                data-placeholder="Select">
                                    @foreach($question->options as $option)
                                        <option value="{{$option}}" 
                                        {{in_array($option, is_array(@$json[$question->question_title]) ? @$json[$question->question_title] : []) ? 'selected' : ''}}>{{$option}}</option>
                                    @endforeach
                                </select>
                            
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>