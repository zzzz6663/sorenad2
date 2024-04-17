 
    <div class="col-lg-4">
        <div class="form-group">
            <label class="form-label" for="device">
                تبلیغ در چه دستگاهی نمایش داده شود ؟
            </label>
            <div class="form-control-wrap">
                <div class="form-control-select">
                    <select class="form-control" name="device" id="device">
                        <option value="">انتخاب کنید </option>
                        <option {{ old("device")=="mobile"?"selected":"" }} value="mobile">موبایل</option>
                        <option {{ old("device")=="computer"?"selected":"" }} value="computer">کامپیوتر</option>
                        <option {{ old("device")=="mobile_computer"?"selected":"" }} value="mobile_computer">موبایل و کامپیوتر</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

