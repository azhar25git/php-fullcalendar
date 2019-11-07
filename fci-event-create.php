<div class="row">
    <div class="col-sm-6">
        <label>Name</label>
        <input class="form-control" type="text" name="title" id="title" placeholder="Name">
        <br />
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="input-group">
            <label>Repeats?</label>
            <select class="form-control" name="repeating" id="repeating">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <br />
            <div id="freq" style="display: none;">
                <div class="input-group">
                    <span class="input-group-addon">Every:&nbsp;</span>
                    <!-- <input class="freq-a form-control" type="number" name="repeat_times" value=1 id="repeat_times" style="width:65px;" required> -->
                    <select class="freq-a form-control" name="repeat_interval" id="repeat_interval" style="width:100px;" required>
                        <option value="1">Day</option>
                        <option value="2">Week</option>
                        <option value="3">Month</option>
                        <option value="4">Year</option>
                    </select>

                </div>
                <div class="input-group">
                    <span class="input-group-addon">Repeat Upto</span>
                    <input class="freq-a form-control" type="number" name="repeat_total" value=2 id="repeat_total" style="width:65px;" required>
                    <span class="input-group-addon">Times</span>

                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">Start:&nbsp;</span>
            <input class="form-control" type="date" name="start_date" placeholder="Start" value=<?php //date('Y-m-d'); 
                                                                                                ?> id="start_date">
            {!! Form::input('date','start_date',date('Y-m-d'),['placeholder'=>'Start','class'=>'form-control']) !!}
        </div>
        <br />
        <div class="input-group">
            <span class="input-group-addon">End:&nbsp;&nbsp;</span>
            <input class="form-control" type="date" name="end_date" placeholder="Start" value=<?php //date('Y-m-d'); 
                                                                                                ?> id="end_date">
            {!! Form::input('date','end_date',date('Y-m-d'),['placeholder'=>'End','class'=>'form-control']) !!}
        </div>
    </div> -->
</div>