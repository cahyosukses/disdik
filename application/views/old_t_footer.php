       	<div class="span12" style="margin-left: 5px">
				<div class="span6 wellwhite">
				<div class="span12">
				<legend>Galeri Foto</legend>
				<?php 
				$q_galeri_depan = $this->db->query("SELECT * FROM galeri ORDER BY RAND() DESC LIMIT 8")->result();
				
				foreach($q_galeri_depan as $qg){ ?>
					<a class="fancybox" href="<?php echo base_URL()."upload/galeri/".$qg->file;?>" data-fancybox-group="gallery" title="<?php echo strtoupper($qg->judul)?>">
						<img class="span3 image-polaroid" src="<?php echo base_URL()."timthumb?src=/upload/galeri/".$qg->file;?>&w=99&h=70&zc=0" style="height: 70px; margin: 0 8px 10px 0">
					</a>
				<?php } ?>
				</div>
				
				</div>
				<div class="span3 wellwhite">
				<legend>Tautan</legend>
					<ul>	
						<?php 
						$q_link 	= $this->db->query("SELECT * FROM link LIMIT 10")->result();
						foreach ($q_link as $ql) {
						?>
							<li><a style="font-size: 12px" href="<?php echo $ql->alamat?>" target="blank"><?php echo $ql->nama?></a></li>
						<?php 
						}
						?>
						
					</ul>
				</div>
				<div class="span3 wellwhite">
				<legend>Statistik Situs</legend>
					<ul>
						<?php $current_date = date('Y-m-d');?>	
						<?php $hari_ini = $this->db->query("SELECT COUNT(*) as jml FROM view_stats WHERE DATE(tgl) = '$current_date'")->row();?>
						<?php $bulan_ini = $this->db->query("SELECT COUNT(*) as jml FROM view_stats WHERE YEAR(tgl) = YEAR(NOW()) AND MONTH(tgl) = MONTH(NOW())")->row();?>
						<?php $total = $this->db->query("SELECT COUNT(*) as jml FROM view_stats")->row();?>

						<li>IP Anda : <?php echo $this->input->ip_address(); ?></li>						
						<li>Hari : <?php echo $hari_ini->jml;?> Views</li>
						<li>Bulan : <?php echo $bulan_ini->jml;?> Views</li>
						<li>Total : <?php echo $total->jml;?> Views</li>

					</ul>
				</div>

			</div>

	
		
      </div><!--/row-->
		<hr>	
	
	<a href="#" class="back-to-top">Back to Top</a>
    <footer>
		<div><center>Loaded in : {elapsed_time}. &copy; Dinas Pendidikan @ 2015</center></div>
	</footer>



    </div><!--/.fluid-container-->

	

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_URL()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_URL()?>assets/js/jquery.marquee/jquery.marquee.min.js"></script>
    <script src="<?php echo base_URL()?>assets/js/news.box.js"></script>
    <script src="<?php echo base_URL()?>assets/calendar/jquery.eventCalendar.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-tab.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-popover.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-button.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-typeahead.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-typeahead.js"></script>
    <script src="<?php echo base_URL()?>assets/js/bootstrap-typeahead.js"></script>
	<script type="text/javascript" src="<?php echo base_URL()?>assets/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo base_URL()?>assets/fancybox/jquery.mousewheel.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_URL()?>assets/fancybox/jquery.fancybox.css" media="screen" />


	<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
		$('.marquee').marquee({
		    //speed in milliseconds of the marquee
		    duration: 20000,
		    //gap in pixels between the tickers
		    gap: 50,
		    //time in milliseconds before the marquee will start animating
		    delayBeforeStart: 0,
		    //'left' or 'right'
		    direction: 'left',
		    //true or false - should the marquee be duplicated to show an effect of continues flow
		    duplicated: false,
		    pauseOnHover:true
		});


      $("#eventCalendarHumanDate").eventCalendar({
           eventsjson: '<?php echo base_url() . 'tampil/generate_event_calendar'?>',
           startWeekOnMonday: false,
           jsonDateFormat: 'human',  // 'YYYY-MM-DD HH:MM:SS'
           monthNames: [ "Januari", "Februari", "Maret", "April", "Mei", "juni","Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
           dayNames: [ 'Minggu','Senen','Selasa','Rabu','Kamis','Jumat','Sabtu' ],
           dayNamesShort: [ 'Ming','Sen','Sel','Rab', 'Kam','Jum','Sab' ],
           txt_noEvents: "Tidak Ada Agenda",                        
           txt_GoToEventUrl: "Lihat agenda",
           txt_NextEvents: "Agenda selanjutnya:",
           eventsLimit: 4
      });

	});
	
	$('.carousel').carousel({
		interval: 3000
	});
	
	$(function () {
		$('#myTab a:first').tab('show');

		$(".pengumuman").bootstrapNews({
			newsPerPage: 3,
			navigation: true,
			autoplay: true,
			direction:'up', // up or down
			animationSpeed: 'normal',
			newsTickerInterval: 3000, //4 secs
			pauseOnHover: true,
			onStop: null,
			onPause: null,
			onReset: null,
			onPrev: null,
			onNext: null,
			onToDo: null
		});


	});

	jQuery(document).ready(function() {
	    var offset = 220;
	    var duration = 500;
	    jQuery(window).scroll(function() {
	        if (jQuery(this).scrollTop() > offset) {
	            jQuery('.back-to-top').fadeIn(duration);
	        } else {
	            jQuery('.back-to-top').fadeOut(duration);
	        }
	    });
	    
	    jQuery('.back-to-top').click(function(event) {
	        event.preventDefault();
	        jQuery('html, body').animate({scrollTop: 0}, duration);
	        return false;
	    })
	});

	</script>
  </body>
</html>