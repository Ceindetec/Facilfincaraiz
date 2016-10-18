@extends('layouts.principal')

@section('style')

@endsection

@section('content')
<!---->

<div class="row">
	<div class="col-xs-12" style="margin-bottom: 30px">
		<h2 class="text-center h2Josefin"> Elige qué quieres publicar </h2>
	</div>
</div>

<div class="bride-grids">
	<div class="container">
		<div class="col-md-4 bride-grid">
			<div class="content-grid l-grids">
				<a href="{{route("publicarXCategoria","Inmuebles")}}">
					<figure class="effect-bubba">
						<img src="images/b1.jpg" alt=""/>
						<figcaption>
							<h4>Inmuebles </h4>
							<p>In sit amet sapien eros Integer in tincidunt labore et dolore magna aliqua</p>
						</figcaption>
					</figure>
				</a>
				<div class="clearfix"></div>
				<h3 class="text-center">Inmuebles</h3>
			</div>
		</div>
		<div class="col-md-4 bride-grid">
			<div class="content-grid l-grids">
				<a href="{{route("publicarXCategoria","Terrenos")}}">
					<figure class="effect-bubba">
						<img src="images/b1.jpg" alt=""/>
						<figcaption>
							<h4>Terrenos </h4>
							<p>In sit amet sapien eros Integer in tincidunt labore et dolore magna aliqua</p>
						</figcaption>
					</figure>
				</a>
				<div class="clearfix"></div>
				<h3 class="text-center">Terrenos</h3>
			</div>
		</div>
		<div class="col-md-4 bride-grid">
			<div class="content-grid l-grids">
				<a href="{{route("publicarXCategoria","Vehiculos")}}">
					<figure class="effect-bubba">
						<img src="images/b3.jpg" alt=""/>
						<figcaption>
							<h4>Vehículos </h4>
							<p>In sit amet sapien eros Integer in tincidunt labore et dolore magna aliqua</p>
						</figcaption>
					</figure>
				</a>
				<div class="clearfix"></div>
				<h3 class="text-center">Vehículos </h3>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!---->
@endsection

@section('scripts')

	<script>

	</script>

@endsection