        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="page-title">Basic Inputs</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="card-title">Basic Inputs</h4>
                            <form class="form-horizontal" action="#">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Text Input</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Disabled Input</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Readonly Input</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="readonly" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Placeholder</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Placeholder">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">File input</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="file">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Default select</label>
                                    <div class="col-lg-10">
                                        <select class="form-control">
                                            <option>-- Select --</option>
                                            <option>Option 1</option>
                                            <option>Option 2</option>
                                            <option>Option 3</option>
                                            <option>Option 4</option>
                                            <option>Option 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Radio</label>
                                    <div class="col-lg-10">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="radio"> Option 1
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="radio"> Option 2
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="radio"> Option 3
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Checkbox</label>
                                    <div class="col-lg-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox"> Option 1
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox"> Option 2
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox"> Option 3
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Textarea</label>
                                    <div class="col-lg-10">
                                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter text here"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Input Addons</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input class="form-control" type="text">
                                            <span class="input-group-btn">
													<button class="btn btn-primary" type="button">Button</button>
												</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">Input Sizes</h4>
                            <form class="form-horizontal" action="#">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Large Input</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control input-lg" placeholder=".input-lg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Default Input</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder=".form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Small Input</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control input-sm" placeholder=".input-sm">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">Validation Inputs</h4>
                            <form class="form-horizontal" action="#">
                                <div class="form-group has-warning has-feedback">
                                    <label class="control-label col-lg-2">Warning Input</label>
                                    <div class="col-lg-10">
                                        <input class="form-control form-control-warning" placeholder=".has-warning" type="text">
                                        <span class="help-block">Warning input helper</span>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback">
                                    <label class="control-label col-lg-2">Success Input</label>
                                    <div class="col-lg-10">
                                        <input class="form-control form-control-success" placeholder=".has-success" type="text">
                                        <span class="help-block">Success input helper</span>
                                    </div>
                                </div>

                                <div class="form-group has-error has-feedback">
                                    <label class="control-label col-lg-2">Error Input</label>
                                    <div class="col-lg-10">
                                        <input class="form-control form-control-danger" placeholder=".has-error" type="text">
                                        <span class="help-block">Error input helper</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>