@extends($template)

@section('content')
<!--team banner start-->
<div class="container-fluid  team-banner vh-center">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center team-banner-text">
							<div>
							<h3>UNSER TEAM</h3>
							<h4>Jeder auf seine Weise.</h4>
							<h3>Gemeinsam unschlagbar.</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--team banner end-->
			
			<!--OUR PRINCIPLES start-->
			<div class="container-fluid  team-members">
				<div class="container">
					<h4 class="text-center tm-head">Das Kidwedo-Team ist das tollste der Welt!</h4>
					<div class="row">
						<div class="col-lg-4 mb-15">
							<div class="t-members-outer p-15">
								<div class="team-thmb text-center">
									<img src="images/ceo.jpg" class="img-fluid">
								</div>
								<div class="team-caption text-center">
									<h4>Nicol Nestmann</h4>
									<h6>CEO</h6>
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-15">
							<div class="t-members-outer p-15">
								<div class="team-thmb text-center">
									<img src="images/cfo.jpg" class="img-fluid">
								</div>
								<div class="team-caption text-center">
									<h4>Joshua Helmchen</h4>
									<h6>CFO CMO</h6>
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-15">
							<div class="t-members-outer p-15">
								<div class="team-thmb text-center">
									<img src="images/question-mark.png" class="img-fluid">
								</div>
								<div class="team-caption text-center">
									<h4><a href="{{ route('career') }}">Komm ins Team</a> </h4>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-15">
							<div class="t-members-outer p-15">
								<div class="team-thmb text-center">
									<img src="images/question-mark.png" class="img-fluid">
								</div>
								<div class="team-caption text-center">
								<h4><a href="{{ route('career') }}">Komm ins Team</a> </h4>
								
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-15">
							<div class="t-members-outer p-15">
								<div class="team-thmb text-center">
									<img src="images/question-mark.png" class="img-fluid">
								</div>
								<div class="team-caption text-center">
								<h4><a href="{{ route('career') }}">Komm ins Team </a></h4>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-15">
							<div class="t-members-outer p-15">
								<div class="team-thmb text-center">
									<img src="images/question-mark.png" class="img-fluid">
								</div>
								<div class="team-caption text-center">
								<h4><a href="{{ route('career') }}">Komm ins Team </a></h4>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--OUR PRINCIPLES end-->
@endsection