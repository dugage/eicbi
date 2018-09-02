<template v-if="rol == 'Customer' || rol == 'User'">

    <h4 class="card-title">{{ trans('app.users.userData') }}</h4>

    <div class="form-group" :class="{'has-error': errors.has('card_number') }">
        <label>{{ trans('app.cardNumber') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.cardNumber') }}" v-model="formFields.card_number" name="card_number" id="card_number" type="text">
        <span class="alert-danger" v-text="errors.first('card_number')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('country') }">
        <label>{{ trans('app.country') }}</label>
        <select @change="getPrefix" name="country" data-vv-as="{{ trans('app.country') }}" v-validate="'required'" v-model="formFields.country" class="form-control" id="country">
            <option value=""></option>
            @foreach($countries as $country)
                    <option value="{{ $country->name }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <span class="alert-danger" v-text="errors.first('video_category_id')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('city') }">
        <label>{{ trans('app.city') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.city') }}" v-model="formFields.city" name="city" id="city" type="text">
        <span class="alert-danger" v-text="errors.first('city')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('address') }">
        <label>{{ trans('app.address') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.address') }}" v-model="formFields.address" name="address" id="address" type="text">
        <span class="alert-danger" v-text="errors.first('address')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('prefix') }">
        <label>{{ trans('app.prefix') }}</label>
        <input disabled class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.prefix') }}" v-model="formFields.prefix" name="prefix" id="prefix" type="text">
        <span class="alert-danger" v-text="errors.first('prefix')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('telephone') }">
        <label>{{ trans('app.telephone') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.telephone') }}" v-model="formFields.telephone" name="telephone" id="telephone" type="text">
        <span class="alert-danger" v-text="errors.first('telephone')"></span>
    </div>

</template>
