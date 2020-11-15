<form method="post" action="{{ route('subjects.store') }}" enctype="multipart/form-data" >
    @csrf
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
		      <label for="name">Subject Name</label><span style="color:red"> *</span>
		      <input type="text" id="name" class="form-control" name="name" value="{{old('name')}}" placeholder="Subject Name" required>
		    </div>
		    <div class="modal-footer justify-content-between" id="quickViewModalFooter">
		      <button type="submit" class="btn btn-primary">Save</button>
		      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		</div>
	</div>
</form>
