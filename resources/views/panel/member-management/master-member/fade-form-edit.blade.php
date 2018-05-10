<div class="fade" style="display: none;">
	<div class="optt">
        <div class="optts">
			<div class="row">
				<p class="col-md-4">
					<input id="nameSub" type="text" class="form-control" name="nameSub[]" aria-describedby="nameSub-error" placeholder="Name Sub">
					<em id="nameSub-error" class="error invalid-feedback">Please enter a new name</em>
				</p>
				<p class="col-md-4">
			        <select name="type[]" class="form-control type" aria-describedby="type-error">
			        	<option value=""></option>
			        @foreach ($products as $products)
			          	<option value="{{$products->id}}" >{{$products->type}}</option>
			        @endforeach
			        </select>
			      	<em id="type-error" class="error invalid-feedback">Please select a type</em>
			  	</p>
				<p class="col-md-3">
			        	<select name="sales[]" class="form-control sales" aria-describedby="sales-error">
			        		<option value=""></option>
			        @foreach ($modUsers as $modUsers)
			          		<option data-name="{{$modUsers->name}}" data-email="{{$modUsers->email}}" value="{{$modUsers->id}}" >{{$modUsers->name}}</option>
			        @endforeach
			        	</select>
			      <em id="sales-error" class="error invalid-feedback">Please enter a new sales</em>
			  	</p>
			  	<p class="col-md-1">
		            <button class="btn btn-danger rounded pull-right" id="minmore" onclick="$(this).closest('.option-card2 .optts').remove()">
		                <i class="fa fa-trash"></i>
		            </button>
			    </p>
	            <!-- 
			    <div class="input-group col-md-2">
					<span class="input-group-text"><i class="fa fa-user-circle-o" ></i></span>
						<input type="text" class="form-control" name="name[]" readonly>
				</div>
				<div class="input-group col-md-2">
					<span class="input-group-text"><i class="fa fa-envelope" ></i></span>
						<input type="text" class="form-control" name="email[]" readonly>
				</div> -->
			</div>
		</div>
		<!-- 
		<br> -->
	</div>
</div>