<!DOCTYPE html>
<html>
	<body>
        <div class="body">
            <form class="form-group" action="ProviderPage.php" method="POST">
                <div class="modal-body">
                    <div class="row form-group" style="margin-top: 2%; height:10%;">
                        <div class="form-group col-lg-12">
                            <input placeholder="Addressee Name" id="addresseename" name="addresseename" type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '')">
                            <label class="active" for="addresseename">Addressee</label>
                        </div>
                        <div class="form-group col-lg-12">
                            <input placeholder="Addressee Position" id="addresseeposition" name="addresseeposition" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '')">
                            <label class="active" for="addresseeposition">Addressee Position(e.g. Adminisitrator)</label>
                        </div>
                        <div class="form-group col-lg-12">
                            <input placeholder="Addressee To Mention in GL" id="addresseetomention" name="addresseetomention" type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '')">
                            <label class="active" for="addresseetomention">Addressee To Mention(e.g. Mr. Dela Cruz OR Leave Empty if None)</label>
                        </div>
                        <div class="form-group col-lg-12">
                            <input placeholder="Company Name" id="companyname" name="companyname" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '')"
                            <label class="active" for="companyname">Company Name</label>
                        </div>
                        <div class="form-group col-lg-12">
                            <input placeholder="Company Address" id="companyaddress" name="companyaddress" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '')">
                            <label class="active" for="companyaddress">Company Address(Complete)</label>
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