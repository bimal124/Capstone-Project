<section class="bookNow">
<h3 class="mb-4 text-uppercase text-center">Book a DrSathi appointment</h3>
<p class="fs-large fc-danger text-center mb-5"> If you are booking an appointment after 9pm we will contact you at 8:00 am the following day to set a time for the visit.</p>
<h5>Please <a href="<?php echo base_url('schedule')?>">click here</a> to book a DrSathi appointment for your client.</h5>
<h5>House Call Visit:  sick visit or COVID test anywhere from 1-4 family members per visit</h5>
<ul class="fc-blue">
		<li>Kathmandu: <strong>Rs. 1500</strong> per visit</li>
		<li>Additional family members: sick visit: <strong>Rs. 1250</strong> each</li>
		<li>Outside of Kathmandu: <strong>Rs. 2350</strong></li>
        	
</ul>

<h5>Out Side of Kathmandu: please call +977-1-554756  COVID Testing</h5>
<ul class="fc-blue">
	<li>PCR Nasal Swab Test: <strong>Rs. 1300 </strong>(1-4 family members), Rs. 1100 for additional family members. Results 24-48 hours.</li>
	<li>Rapid Antigen Test: <strong>Rs. 1350</strong> (1-2 family members) Results within 10-15 min</li>
	<li>Serum Antibodies: <strong>Rs. 1350</strong> (1-2 family members), <strong>Rs. 1125</strong> for each additional test <strong>Results 24-48 hours</strong></ul>
</ul>

<div class="inn mt-5">
	<?php 
	$this->load->view('common/appointment-form');
	?>
</div>
</section>