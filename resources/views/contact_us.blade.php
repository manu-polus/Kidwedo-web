@extends($template)

@section('content')
<!--activity-view-contents-->
<section class="container-fluid register-bg">
				<div class="container">
				<div class="activity-view  add-activity-outer mb-20 w-70 m-auto">
					<h5>KONTAKT</h5>
					<div class="row p-15">
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" class="custom-input" placeholder="Name">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" class="custom-input" placeholder="E-mail">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input type="text" class="custom-input" placeholder="Betreff">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<textarea class="custom-textarea" rows="4"  placeholder="Nachricht schreiben"></textarea>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="form-group">
								<button type="button" class="kid-btn kid-small-btn w-100 bg-color-1 bd-color-1">ABSCHICKEN</button>
							</div>
						</div>
						
						
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-6">
								<ul class="footer-links ad-clr">
									<p>Kidwedo UG<br>
									Akazeinstrabe 3A, 10823 Berlin</p>
									<p><a href="">hello@kidwedo.de</a></p>
								</ul>
							</div>
							<div class="col-lg-12 mb-20">
								<div class="w-100 ac-providers">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2429.578646214085!2d13.353405715502115!3d52.48676437980787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a85040fb8711b9%3A0xd1f0ee404016d2a8!2sAkazienstra%C3%9Fe+3a%2C+10827+Berlin%2C+Germany!5e0!3m2!1sen!2sin!4v1552394757296" style="border:0" allowfullscreen="" width="100%" height="450" frameborder="0"></iframe>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				</div>
			</section>
			<!--activity-view-contents end-->
@endsection