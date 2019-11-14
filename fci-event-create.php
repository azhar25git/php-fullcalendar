<!-- <div class="row"> -->
<div class="col-sm-8">
    <label>Name</label>
    <input class="form-control" type="text" name="title" id="title" placeholder="Name">
    <br />
</div>


<div class="col-sm-8" style="padding-right:0px;">
    <label for="repeating">Repeats?</label>
    <div class="input-group">

        <select class="form-control" name="repeating" id="repeating">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
</div>

<div id="freq" class="col-sm-12" style="display: none;">

    <div class="input-group col-sm-8" style="padding:0px;">
        <div class="input-group-prepend" style="padding:0px;"> <span class="input-group-text">Every:&nbsp;</span> </div>

        <select class="freq-a form-control " name="repeat_interval" id="repeat_interval" required>
            <option value="1">Day</option>
            <option value="2">Week</option>
            <option value="3">Month</option>
            <option value="4">Year</option>
        </select>

    </div>

    <div class="input-group col-sm-8" style="padding:0px;">
        <div class="input-group-prepend"> <span class="input-group-text">Repeat Upto</span> </div>

        <input class="freq-a form-control" type="number" name="repeat_total" value=2 id="repeat_total" style="width:65px;" required>

        <div class="input-group-append"> <span class="input-group-text">times</span> </div>

    </div>
</div>