<hr />
@if ($model->edited_user_id)
    <input-show name="edited_user_id" :model="$model" :value="$model->edited_user_name"  />
@endif

<input-show name="created_at" :model="$model"  />
<input-show name="updated_at" :model="$model"  />