@foreach ($prodcuts as $prodcut)
    <div class="col-md-6 col-lg-4">
        <div class="card text-center card-product">
            <div class="card-product__img">
                <img class="card-img" src="{{ $prodcut->image }}" alt="{{ $prodcut->id }}">
                <ul class="card-product__imgOverlay">
                    <li><button><i class="ti-shopping-cart"></i></button></li>
                    <li><button><i class="ti-heart"></i></button></li>
                </ul>
            </div>
            <div class="card-body">
                <h4 class="card-product__title"><a
                        href="{{ route('shop.show', $prodcut->id) }}">{{ $prodcut->name }}</a></h4>
                <p class="card-product__price">${{ $prodcut->price }}</p>
            </div>
        </div>
    </div>
@endforeach
