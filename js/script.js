var plugin_url = 'fci-index.php';

$(document).ready(function(){
        var calendar = $("#calendar").fullCalendar({
          header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay,listMonth"
          },
          defaultView: "month",
          editable: true,
          selectable: true,
          allDaySlot: false,
          selectHelper: true,
          droppable: true,
          weekends: true,

          events: plugin_url + "?view=1",

          eventClick: function(event, jsEvent, view) {
            endtime = $.fullCalendar.moment(event.end).format("h:mm");
            starttime = $.fullCalendar
              .moment(event.start)
              .format("dddd, MMMM Do YYYY, h:mm");
            var mywhen = starttime + " - " + endtime;
            $("#modalTitle").html(event.title);
            $("#modalWhen").text(mywhen);
            $("#eventID").val(event.id);
            $("#calendarModal").modal();
          },

          //header and other values
          select: function(start, end, jsEvent) {
            endtime = $.fullCalendar.moment(end).format("h:mm");
            starttime = $.fullCalendar
              .moment(start)
              .format("dddd, MMMM Do YYYY, h:mm");
            var mywhen = starttime + " - " + endtime;
            start = moment(start).format();
            end = moment(end).format();
            $("#createEventModal #startTime").val(start);
            $("#createEventModal #endTime").val(end);
            $("#createEventModal #when").text(mywhen);
            $("#createEventModal").modal("toggle");
          },
          eventDrop: function(event, delta) {
            $.ajax({
              url: plugin_url,
              data:
                "action=update&title=" +
                event.title +
                "&start=" +
                moment(event.start).format() +
                "&end=" +
                moment(event.end).format() +
                "&id=" +
                event.id,
              type: "POST",
              success: function(json) {
                //alert(json);
              }
            });
          },
          eventResize: function(event) {
            $.ajax({
              url: plugin_url,
              data:
                "action=update&title=" +
                event.title +
                "&start=" +
                moment(event.start).format() +
                "&end=" +
                moment(event.end).format() +
                "&id=" +
                event.id,
              type: "POST",
              success: function(json) {
                //alert(json);
              }
            });
          }
        });
               
       $('#submitButton').on('click', function(e){
           // We don't want this to act as a link so cancel the link action
           e.preventDefault();
           doSubmit();
       });
       
       $('#deleteButton').on('click', function(e){
           // We don't want this to act as a link so cancel the link action
           e.preventDefault();
           doDelete();
          //  window.location = plugin_url;
          location.reload(false);
       });
       
      //  $('#deleteGroup').on('click', function (e) {
      //      // We don't want this to act as a link so cancel the link action
      //      e.preventDefault();
      //      doGroupDelete();
      //  });
       
       function doDelete(){
           $("#calendarModal").modal('hide');
           var eventID = $('#eventID').val();
           $.ajax({
               url: plugin_url,
               data: 'action=delete&id='+eventID,
               type: "POST",
               success: function(json) {
                   if(json == 1)
                        $("#calendar").fullCalendar('removeEvents',eventID);
                   else
                        return false;
                    
                   
               }
           });
       }

       function doGroupDelete(){
           $("#calendarModal").modal('hide');
           var eventID = $('#eventID').val();
           $.ajax({
               url: plugin_url,
               data: 'action=delete&id='+eventID+'&group=group',
               type: "POST",
               success: function(json) {
                 console.log(json);
                   if(json == 1)
                        $("#calendar").fullCalendar('removeEvents',eventID);
                   else
                        return false;
                  console.log(json);
                   
               },
               error: function(json, error) {
                 console.log(error);
               }

           });
       }
       function doSubmit(){
           $("#createEventModal").modal('hide');
           var title = $('#title').val();
           var startTime = $('#startTime').val();
           var endTime = $('#endTime').val();
           var repeating = $("#repeating").val();
          //  console.log(repeating);
           var data;
           if (repeating == 1){
             var repeat_times = $("#repeat_times").val() || 1;
             var repeat_interval = $("#repeat_interval").val();
             var repeat_total = $("#repeat_total").val();
             data = 'action=add&title='+title+'&start='+startTime+'&end='+endTime+'&repeating='+repeating+'&repeat_times='+repeat_times+'&repeat_interval='+repeat_interval+'&repeat_total='+repeat_total;
           } else {
              data = 'action=add&title='+title+'&start='+startTime+'&end='+endTime+'&repeating='+0;
           }
          //  console.log(data);
           $.ajax({
               url: plugin_url,
               data: data,
               type: "POST",
               success: function(json) {
                  // console.log('success: ', json);
                  //  $("#calendar").fullCalendar('renderEvent',
                  //  {
                  //      id: json.id,
                  //      title: title,
                  //      start: startTime,
                  //      end: endTime,
                  //  },
                  //  true);
                  //  window.location = plugin_url;
                  location.reload(false);
               },
               error: function (json, error) {
                //  console.log('error: ', error);
               }
           });
           
       } 
       $("#repeating").change(function() {
         $("#freq").toggle();
         $("#due-by").toggle();
       });
    });