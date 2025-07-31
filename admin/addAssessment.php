<!DOCTYPE html>
<html>
	<body>
	<div class="body">
        <form class="form-group" action="GISassessment.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input placeholder="Assessment Option" id="assopt" name="assopt" type="text" class="form-control">
                        <label class="active" for="assopt">Assessment Option</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Problem Presented" id="prob_pre" name="prob_pre" type="text" class="form-control" required></textarea>
                        <label class="active" for="prob_pre">Problem Presented</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Social Work Assessment" id="swass" name="swass" type="text" class="form-control" required></textarea>
                        <label class="active" for="swass">Social Work Assessment</label>
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