 <div class="create-form">
    <form method="POST">
        <!--  General -->
        <div class="form-group">
            <h2 class="section-headline">PUBLIC DETAILS</h2>

            <div>
                <label for="title">Title</label>
                <input type="text" placeholder="Accounts Name ..." id="title" name="title" value="{{ old('title') }}" />
                @error('title')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <label for="price">Price<small>($)</small></label>
                <input type="text" placeholder="Product Cost..." id="price" name="price" value="{{ old('price') }}" />
                @error('price')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <label for="delivery_type">Delivery Type</label>
                <select name="delivery_type" id="delivery_type">
                    <option value="instant" selected>Instant</option>
                </select>
                @error('delivery_type')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <label for="country">Country</label>
                <select name="country" id="country">
                    @foreach (config('country') as $country)
                        <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                @error('country')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <label for="description">Description</label>
                <textarea rows=5 type="text" placeholder="was created 5 years ago..." id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-group" id="private_data_container">
            <h2 class="section-headline">
                <span>PRIVATE DETAILS</span>
                <span class="sub-title">Those details will be shared with Clients after the purchase process is completed</span>
            </h2>

            <div>
                <label for="account_details">Account Private Details</label>
                <textarea rows=5 type="text" placeholder="Username: aaa, Password: bbb, Login Link: xxxx..." id="account_details"
                    name="account_details">{{ old('account_details') }}</textarea>
                @error('account_details')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="document_links">PRIVATE LINKS</label>
                <textarea rows=5 type="text" placeholder="Documents Link  , Nox Profile ... " id="document_links"
                    name="document_links">{{ old('document_links') }}</textarea>
                @error('account_details')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="form-btn-wrapper">
            <input type="submit" value="CREATE">
        </div>

    </form>
