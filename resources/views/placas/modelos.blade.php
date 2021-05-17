<div class="row">

    @foreach ($modelos as $modelo)

        <div class="col-12 col-lg-4 col-md-6">
            <div class="model-item">
                <input type="radio" name="model" id="model-option-{{ $modelo['id'] }}" value="{{ $modelo['id'] }}"
                    class="input-hidden radioModel" required />
                <label for="model-option-{{ $modelo['id'] }}" class="modelOption">
                    <img class="img-fluid"
                        src="{{ asset('storage/' . $modelo['image']) }}" />
                </label>
            </div>
        </div>

    @endforeach

</div>