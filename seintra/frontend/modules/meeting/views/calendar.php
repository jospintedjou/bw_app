<?php

use yii\web\JqueryAsset;
frontend\assets\AppAsset::register($this);
$mincalendarCSS = 'css/fullcalendar.min.css';
$printcalendarCSS = 'css/fullcalendar.print.css';
$bootstrapCSS = 'css/bootstrap.min.css';
$fontCSS = 'css/font-awesome.min.css';

$jqueryJS = 'js/jquery.min.js';
$mincalendarJS = 'js/fullcalendar.min.js';
$bootstrapJS = 'js/bootstrap.min.js';
$fastClickJS = 'js/fastclick.js';
$nprogressJS = 'js/nprogress.js';
$mommentJS = 'js/moment.min.js';

$this->registerCssFile($mincalendarCSS);
$this->registerCssFile($printcalendarCSS);
//$this->registerCssFile($bootstrapCSS);
//$this->registerCssFile($fontCSS);
 
?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>REUNIONS <small>Créer Une Nouvelle Réunion</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Calendrier des reunions <small>Sessions</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div id="calendar"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->

<!-- calendar modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Créer Une Nouvelle Réunion</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Titre</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"  rows="10" cols="50"></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Lieu</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title10" name="title10">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Heure-Début</label>
                  <div class="col-sm-9">
                    <input type="time" class="form-control" id="title11" name="title11">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Heure-Fin</label>
                  <div class="col-sm-9">
                    <input type="time" class="form-control" id="title12" name="title12">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label" for="participants">Participants:</label>
                  <div class="col-sm-9">
				   <select name="Participants" id="participants" multiple size="10">
				    <optgroup label="CAB DG">
					   <option value="DEV1">DG</option>
					   <option value="DEV7">AD-Josiane</option>
					</optgroup>
					<optgroup label="DIRECTION COM">
						<option value="DEV7">==//==</option>
					</optgroup>
					<optgroup label="DIRECTION TECHNIQUE">
						<option value="DEV2">DT-Patrick</option>
					</optgroup>
					<optgroup label="SALLE IT">
						<option value="DEV3">DEV3-Ngauss</option>
					    <option value="DEV4">DEV4-Jospin</option>
					    <option value="DEV5">DEV5-Yvan</option>
					    <option value="DEV6">DEV6-Miguel</option>
					</optgroup> 
				   </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
 </div>

<div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Modifier une Réunion</h4>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Titre</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title2" name="title2">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr2"  rows="10" cols="50"></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Lieu</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title20" name="title20">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Heure-Debut</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title21" name="title21">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Heure-Fin</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title22" name="title22">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label" for="participants">Participants:</label>
                  <div class="col-sm-9">
				   <select name="Participants" id="participants2" multiple size="10" width="60%">
				    <optgroup label="CAB DG">
					   <option value="DEV1">DG</option>
					   <option value="DEV7">AD-Josiane</option>
					</optgroup>
					<optgroup label="DIRECTION COM">
						<option value="DEV7">==//==</option>
					</optgroup>
					<optgroup label="DIRECTION TECHNIQUE">
						<option value="DEV2">DT-Patrick</option>
					</optgroup>
					<optgroup label="SALLE IT">
						<option value="DEV3">DEV3-Ngauss</option>
					    <option value="DEV4">DEV4-Jospin</option>
					    <option value="DEV5">DEV5-Yvan</option>
					    <option value="DEV6">DEV6-Miguel</option>
					</optgroup> 
				   </select>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Archiver:</label>
                  <div class="col-sm-9">
                    <input type="FILE" class="form-control" id="title" name="title">
                  </div>
                </div>
				<div class="form-group">
                 <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <a href="/yii2_guide_en.pdf" style="color:blue"><u>Consulter le Compte rendu de Réunion</u></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">			
				<button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary antosubmit2">
                                    Save changes
				</button>								  		  
          </div>
        </div>
      </div>
    </div>


<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>

<?php
 
//$this->registerJsFile($jqueryJS);
//$this->registerJsFile($bootstrapJS);

$this->registerJsFile($fastClickJS);

//$this->registerJsFile($nprogressJS);
$this->registerJsFile($mommentJS);
$this->registerJsFile($mincalendarJS);
//$this->registerJsFile('js/custom.js');
$this->registerJsFile('js/bootstrap-progressbar.min.js');
$this->registerJsFile('js/icheck.min.js');
//$this->registerJsFile('js/custom.js');
?>



<!-- Calendar


<script  language="javascript">
    $('document').ready(function () {
        alert('a');
    });
</script>

 -->

 
 <!-- FullCalendar -->
	
	 
    <script>
      $(window).load(function() {
        var date = new Date(),
            d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
            started,
            categoryClass;
//alert(d);
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
            title: 'My new event',
            start: new Date(2016, 6, 1)
           // start: '2016-07-01'
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
        
    </script>