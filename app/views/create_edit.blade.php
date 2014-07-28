<!-- IP -->
				<div class="form-group {{{ $errors->has('ip') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Indirizzo IP</label>
						<input class="form-control" type="text" name="ip" id="ip" value="{{{ Input::old('ip', isset($antenna) ? $antenna->ip : null) }}}" />
						{{{ $errors->first('ip', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ IP antenna -->

				<!-- rssi -->
				<div class="form-group {{{ $errors->has('rssi') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">RSSI</label>
						<input class="form-control" type="text" name="rssi" id="rssi" value="{{{ Input::old('rssi', isset($antenna) ? $antenna->rssi : null) }}}" />
						{{{ $errors->first('rssi', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ bsid antenna -->	

				<!-- bsid -->
				<div class="form-group {{{ $errors->has('bsid') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">BSID</label>
						<input class="form-control" type="text" name="bsid" id="bsid" value="{{{ Input::old('bsid', isset($antenna) ? $antenna->bsid : null) }}}" />
						{{{ $errors->first('bsid', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ bsid antenna -->

				<!-- cmri -->
				<div class="form-group {{{ $errors->has('cmri') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">CMRI</label>
						<input class="form-control" type="text" name="cmri" id="cmri" value="{{{ Input::old('cmri', isset($antenna) ? $antenna->cmri : null) }}}" />
						{{{ $errors->first('cmri', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cmri antenna -->