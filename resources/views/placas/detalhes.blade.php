<div class="row">


    <div class="col-md-12 my-3">

        <h5>Escolha a moldura:</h5>

        <div class="row">

            @foreach ($molduras as $moldura)

                <div class="col-12 col-lg-4 col-md-4">
                    <div class="design-item">
                        <input type="radio" name="design" id="design-option-{{ $moldura['id'] }}"
                            value="{{ $moldura['id'] }}" class="input-hidden radioSize" required />
                        <label for="design-option-{{ $moldura['id'] }}" class="designOption">
                            <img class="img-fluid" src="{{ asset('storage/' . $moldura['image']) }}" />
                        </label>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

    <div class="col-md-12 my-3">
        
        <h5>Escolha a fonte:</h5>

        <div class="row">

            @foreach ($fontes as $fonte)

                <div class="col-12 col-lg-4 col-md-4">
                    <div class="fonte-item">
                        <input type="radio" name="fonte" id="fonte-option-{{ $fonte['id'] }}"
                            value="{{ $fonte['id'] }}" class="input-hidden radioSize" required />
                        <label for="fonte-option-{{ $fonte['id'] }}" class="fonteOption">
                            <img class="img-fluid" src="{{ asset('storage/' . $fonte['image']) }}" />
                        </label>
                    </div>
                </div>

            @endforeach

        </div>

    </div>




</div>
