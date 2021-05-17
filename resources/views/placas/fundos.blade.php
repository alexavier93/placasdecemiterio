<div class="row">

    @foreach ($fundos as $fundo)

        <div class="col-12 col-lg-3 col-md-3">
            <div class="background-item">
                <input type="radio" name="background" id="background-option-{{ $fundo['id'] }}" value="{{ $fundo['id'] }}"
                    class="input-hidden radioModel" required />
                <label for="background-option-{{ $fundo['id'] }}" class="backgroundOption">
                    <img class="img-fluid"
                        src="{{ asset('storage/' . $fundo['image']) }}" />
                </label>
            </div>
        </div>

    @endforeach

</div>