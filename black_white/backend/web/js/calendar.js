$(window).load(function() {
        var date = new Date(),
            d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
            started,
            categoryClass;

        var calendar = $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          selectable: true,
          selectHelper: true,
          select: function(start, end, allDay) {
            $('#fc_create').click();

            started = start;
            ended = end;

            $(".antosubmit").on("click", function() {
              var title = $("#title").val();
			  var descr = $("#descr").val();
			  var lieu = $("#title10").val();
			  var debut = $("#title11").val();
			  var fin = $("#title12").val();
			/*  var participants = $("#Participants").val();*/
			  
              if (end) {
                ended = end;
              }

              categoryClass = $("#event_type").val();

              if (title) {
			 /* $("#participants2").val(participants);*/
                calendar.fullCalendar('renderEvent', {
                    title: title+lieu+debut+fin,
                    start: started,
                    end: end,
                    allDay: allDay
                  },
                  true // make the event "stick"
                );
              }

              $('#title').val('');
              calendar.fullCalendar('unselect');

              $('.antoclose').click();

              return false;
            });
          },
          eventClick: function(calEvent, jsEvent, view) {
            $('#fc_edit').click();
			//alert(calEvent.title);
            $('#title2').val(calEvent.title);
			$("#descr2").val( $( '#descr').val() ) ;
			$("#title20").val($( '#title10').val() );
			$('#title21').val($( '#title11').val());
			$('#title22').val($( '#title12').val());
			$('#participants2').val($( '#participants').val());
            categoryClass = $("#event_type").val();

            $(".antosubmit2").on("click", function() {
              calEvent.title = $("#title2").val();
			  $("#descr").val( $( '#descr2').val() ) ;
			  $("#title10").val($( '#title20').val() );
			  $('#title11').val($( '#title21').val());
			  $('#title12').val($( '#title22').val());
			  $('#participants').val($( '#participants2').val());

              calendar.fullCalendar('updateEvent', calEvent);
			  $('.antoclose2').click();
            });

            calendar.fullCalendar('unselect');
          },
          editable: true,
          events: [{
            title: 'All Day Event',
            start: new Date(y, m, 1)
          }, {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2)
          }, {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: false
          }, {
            title: 'Lunch',
            start: new Date(y, m, d + 14, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false
          }, {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false
          }, {
            title: 'Click for Google',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/'
          }]
        });
      });
        