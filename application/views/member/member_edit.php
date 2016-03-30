<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Member - Edit</h3>
            </div>
            <div class="panel-body">
                <form role="form" action="member_edit" method="post" enctype="multipart/form-data" id="member-edit">
                    <input type="hidden" id="id" name="id" value="<?php echo $member->id_member; ?>"/>
                    <input type="hidden" id="name_default" name="name_default" value="<?php echo $member->name; ?>"/>
                    <input type="hidden" id="email_default" name="email_default" value="<?php echo $member->email; ?>"/>
                    <input type="hidden" id="phone_number_default" name="phone_number_default" value="<?php echo $member->phone_number; ?>"/>
                    <input type="hidden" id="username_default" name="username_default" value="<?php echo $member->username; ?>"/>
                    <div class="form-body padding10">
                        <div class="fontred"><?php if ($create_error) { print_r($create_error); } ?></div>
                        <div class="form-group">
                            <label>Name</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name', ucwords($member->name)); ?>">
                                <?php echo form_error('name', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email', $member->email); ?>">
                                <?php echo form_error('email', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ID Type</label><span class="fontred"> *</span>
                            <select class="form-control" name="idcard_type" id="idcard_type">
                                <option value="">-- Select One --</option>
                                <?php
                                foreach ($code_member_idcard_type as $key => $val)
                                {
                                    echo '<option value="'.$key.'"'.set_select('idcard_type', $key); if ($key == $member->idcard_type) { echo ' selected="selected"'; } echo '>'.$val.'</option>';
                                }
                                ?>
                            </select>
                            <?php echo form_error('idcard_type', '<div class="fontred">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>ID Number</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="idcard_number" id="idcard_number" value="<?php echo set_value('idcard_number', $member->idcard_number); ?>">
                                <?php echo form_error('idcard_number', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ID Address</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <textarea class="form-control height150" name="idcard_address" id="idcard_address"><?php echo set_value('idcard_address', ucwords($member->idcard_address)); ?></textarea>
                                <?php echo form_error('idcard_address', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Shipment Address</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <textarea class="form-control height150" name="shipment_address" id="shipment_address"><?php echo set_value('shipment_address', ucwords($member->shipment_address)); ?></textarea>
                                <?php echo form_error('shipment_address', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" placeholder="12345" name="postal_code" id="postal_code" value="<?php echo set_value('postal_code', $member->postal_code); ?>">
                                <?php echo form_error('postal_code', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kota</label><span class="fontred"> *</span>
                            <select class="form-control" name="id_kota" id="id_kota">
                                <option value="">-- Select One --</option>
                                <?php
                                foreach ($kota_lists as $row)
                                {
                                    echo '<option value="'.$row->id_kota.'"'.set_select('id_kota', $row->id_kota); if ($row->id_kota == $member->id_kota) { echo ' selected="selected"'; } echo '>'.ucwords($row->kota).'</option>';
                                }
                                ?>
                            </select>
                            <?php echo form_error('id_kota', '<div class="fontred">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number', $member->phone_number); ?>">
                                <?php echo form_error('phone_number', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Marital Status</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status" id="marital_status" value="0" <?php if ($member->marital_status == 0) { echo 'checked="checked"'; }; echo set_radio('marital_status', '0'); ?> />Single
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status" id="marital_status" value="1" <?php if ($member->marital_status == 1) { echo 'checked="checked"'; }; echo set_radio('marital_status', '1'); ?> />Married
                                    </label>
                                </div>
                            </div>
                            <?php echo form_error('marital_status', '<div class="fontred">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Occupation</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" placeholder="penyanyi" name="occupation" id="occupation" value="<?php echo set_value('occupation', ucwords($member->occupation)); ?>">
                                <?php echo form_error('occupation', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Religion</label><span class="fontred"> *</span>
                            <select class="form-control" name="religion" id="religion">
                                <option value="">-- Select One --</option>
                                <?php
                                foreach ($code_member_religion as $key => $val)
                                {
                                    echo '<option value="'.$key.'"'.set_select('religion', $key); if ($key == $member->religion) { echo ' selected="selected"'; } echo '>'.$val.'</option>';
                                }
                                ?>
                            </select>
                            <?php echo form_error('religion', '<div class="fontred">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Shirt Size</label><span class="fontred"> *</span>
                            <div class="input-group col-sm-12">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="shirt_size" id="shirt_size" value="0" <?php if ($member->shirt_size == 0) { echo 'checked="checked"'; }; echo set_radio('shirt_size', '0'); ?> />M
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="shirt_size" id="shirt_size" value="1" <?php if ($member->shirt_size == 1) { echo 'checked="checked"'; }; echo set_radio('shirt_size', '1'); ?> />XL
                                    </label>
                                </div>
                            </div>
                            <?php echo form_error('shirt_size', '<div class="fontred">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Change ID Photo</label>
                            <div class="input-group col-sm-12">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="change_idcard_photo" id="change_idcard_photo" value="0" checked="checked" <?php echo set_radio('change_idcard_photo', '0'); ?> />No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="change_idcard_photo" id="change_idcard_photo" value="1" <?php echo set_radio('change_idcard_photo', '1'); ?> />Yes
                                    </label>
                                </div>
                            </div>
                            <?php echo form_error('shirt_size', '<div class="fontred">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>ID Photo</label>
                            <div class="input-group col-sm-12">
                                <input type="file" class="form-control" name="idcard_photo" id="idcard_photo">
                                <?php echo form_error('idcard_photo', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <div class="input-group col-sm-12">
                                <input type="file" class="form-control" name="photo" id="photo">
                                <?php echo form_error('photo', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username', $member->username); ?>">
                                <?php echo form_error('username', '<div class="fontred">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status">
                                <?php
                                foreach ($code_member_status as $key => $val)
                                {
                                    echo '<option value="'.$key.'"'.set_select('status', $key); if ($key == $member->status) { echo ' selected="selected"'; } echo '>'.$val.'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="submit" value="Submit" class="btn blue">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<script>

</script>