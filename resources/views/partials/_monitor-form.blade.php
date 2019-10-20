<div class="row">
    <div class="form-group col-6 {{ $errors->has('name') ? 'alert-danger' : ''}}">
        <label for="">Monitor Name</label>
        <input type="text" name="name" value="{{ $monitor->name ?? old('name') }}" class="form-control">
        <span>{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
    </div>
    <div class="form-group col-6 {{ $errors->has('type') ? 'alert-danger' : ''}}">
        <label for="type">Monitor Type</label>
        <select name="type" id="type" class="form-control">
            <option value="abuse">Abuse</option>
            <option value="negative">Negativity</option>
            <option value="mention">Mention</option>
        </select>
        <span>{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
    </div>
    <div class="form-group col-12">
        <label for="description">Description(optional)</label>
        <textarea name="description" id="description" rows="1" class="form-control">{{ $monitor->description ?? old('description') }}</textarea>
    </div>
</div>