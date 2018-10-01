<form ref="formChapter" class="forms-sample" slot="body">

    <div class="form-group" :class="{'has-error': errors.has('name') }">
        <label>{{ trans('app.courses.chapterName') }}</label>
        <input name="name" id="name" data-vv-as="{{ trans('app.courses.chapterName') }}" v-validate="'required'" v-model="formFields.name" class="form-control" value="" type="text">
        <span class="alert-danger" v-text="errors.first('name')"></span>
    </div>

    <div class="form-group">
        <label>{{ trans('app.courses.chaptertext') }}</label>
        <textarea name="text" id="text" class="form-control" data-vv-as="{{ trans('app.courses.chapterText') }}" v-model="formFields.text" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label>{{ trans('app.courses.chapterCodeVideo') }}</label>
        <input name="video" id="education_name" data-vv-as="{{ trans('app.courses.chapterCodeVideo') }}" v-model="formFields.video" class="form-control" value="" type="text">
    </div>

    <div class="form-group">
        <input name="attached" id="attached" data-vv-as="{{ trans('app.courses.chapterFile') }}" type="file" v-validate="'size:2048'" @change="onFileChanged" class="form-control-file" aria-describedby="fileHelp">
        <span class="alert-danger" v-text="errors.first('attached')"></span>
    </div>

    <div v-if="formFields.course_id > 0 && formFields.attached != null" class="alert alert-secondary">
        {{ trans('app.courses.chapterAttachedFile') }}<br/>
        <a target="_blank" v-text="formFields.attached" :href="'{{asset('/documents')}}/' + formFields.attached" class="alert-link"></a>
    </div>

</form>