<!DOCTYPE html>
<html>
	<body>
	<div class="body">
        <form class="form-group" action="fundsource.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input placeholder="Source Of Fund" id="fundsource" name="fundsource" type="text" class="form-control text-uppercase" required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '').toUpperCase()">
                        <label class="active" for="fundsource">Fund Source</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Description" id="fsdescription" name="fsdescription" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '').toUpperCase()">
                        <label class="active" for="fsdescription">Description</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="Add">Save</button>
            </div>
        </form>
	</div>

</body>
</html>