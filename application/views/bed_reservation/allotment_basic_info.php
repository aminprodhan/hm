<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="page-title mn"><u>Basic Info</u></h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">

          <?php
            $agent_id="";$remarks="";
            foreach($info as $i){
               
                $agent_id=$i["agent_id"];
                $remarks=$i["remarks"];
            }
         ?>


            <label style="width:10%" class="col-sm-2">Agent List</label>
            <div style="width:20%" class="col-sm-2">
                <select id="agent_list" name="agent" class="form-control">
                    <?php foreach($agent_list as $a): ?>
                        <option <?php if($agent_id == $a["id"]): ?>selected<?php endif; ?> value="<?php echo $a["id"] ?>">
                            <?php echo $a["name"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label style="width:10%" class="col-sm-2">Date</label>
            <div style="width:20%" class="col-sm-2">
                <input placeholder="Date" value="<?php echo date('d-m-Y'); ?>" id="date" class="form-control tcal"  />
            </div>
            <label style="width:10%" class="col-sm-2">Remarks</label>
            <div style="width:20%" class="col-sm-2">
                <textarea id="remarks" class="form-control"><?php echo $remarks; ?></textarea>
            </div>


        </div>
    </div>
</div>