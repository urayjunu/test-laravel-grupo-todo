
<ul class="nav nav-tabs"><a class="navbar-brand" href="{{ url('/') }}">
                   <small>Categorias</small>
                </a>
    @foreach($categorias_ as $cate)
		<!--<li class="nav-item">
			<a class="nav-link active" href="#">{{ $cate->nombre }}</a>
		</li>-->
		<li class="nav-item dropdown">
			<a class="nav-link " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $cate->nombre }}</a>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="{{  url('front/productos') }}/{{$cate->id }}">{{ $cate->nombre }}</a>
			  @foreach($categorias as $cat)
			  	@if($cate->id == $cat->subcategoria_id )	
			  		<a class="dropdown-item" href="{{  url('front/productos') }}/{{$cat->id }}">{{ $cat->nombre }}</a>
			  	@endif
			  @endforeach			
			</div>
		</li>
    @endforeach
</ul>