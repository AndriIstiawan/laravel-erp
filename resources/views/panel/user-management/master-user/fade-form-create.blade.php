<div class="fade" style="display: none;">
    @foreach($roles as $role)
    @if($role->name == 'Production')
    <div class="shipping-{{$role->id}}">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <select class="form-control shipping-valid" name="kemasan" aria-describedby="shipping-error" multiple="">
                        <option value=""></option>
                        <option value="250">250 gr</option>
                        <option value="500">500 gr</option>
                        <option value="1000">1 kg</option>
                        <option value="5000">5 kg</option>
                        <option value="25000">25 kg </option>
                        <option value="30000">30 kg</option>
                    </select>
                </div>
                <em id="shipping-error" class="error invalid-feedback"></em>
            </div>
        </div>
    </div>
    @else
    @endif
    @endforeach
</div>