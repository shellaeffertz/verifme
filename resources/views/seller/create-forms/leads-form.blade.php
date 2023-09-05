{{-- <div class="create-form">
    <form method="POST">
        <!--  General -->
        <div class="form-group">


            <h2 class="section-headline">PUBLIC DETAILS</h2>

            <div>
                <label for="title">Title</label>
                <input type="text" placeholder="Account Name..." id="title" name="title" />
            </div>


            <div>
                <label for="price">Price<small>($)</small></label>
                <input type="text" placeholder="Product Cost..." id="price" name="price" />
            </div>

            <div>
                <label for="delivery_type">Delivery Type</label>
                <select name="delivery_type" id="delivery_type">
                    <option value="instant" selected>Instant</option>
                    <option value="preorder">Preorder</option>
                </select>
            </div>

            <div class="hidden" id="delivery_period_container">
                <label for="delivery_period">Delivery Period</label>
                <select name="delivery_period" id="delivery_period">
                    <option value="1d" selected>24H</option>
                    <option value="2d">48H</option>
                </select>
            </div>

            

            <div>
                <label for="leads_type">Leads Type</label>
                <select name="leads_type" id="leads_type">
                    <option value="email" selected>Email</option>
                    <option value="phone">Phone</option>
                    <option value="email_phone">Email & Phone</option>
                    <option value="combolist">ComboList</option>
                </select>
            </div>


            <div>
                <label for="description">Description</label>
                <textarea rows=5 type="text" placeholder="was created 5 years ago..." id="description" name="description"></textarea>
            </div>

        </div>

        <div class="form-group" id="private_data_container">
            <h2 class="section-headline">PRIVATE DETAILS <small>Only shared with Clients after the purchase process is completed</small></h2>
            <div>
                <label for="account_details">Leads Details</label>
                <textarea rows=5 type="text" placeholder="Jhon Due,jhon.due@example.com..." id="account_details" name="account_details"></textarea>
            </div>

            <div>
                <label for="document_links">Document Links</label>
                <textarea rows=5 type="text" placeholder="any links to download or extra details that can be provided..." id="document_links" name="document_links"></textarea>
            </div>
        </div>
        <input type="submit" value="CREATE">

    </form>
 --}}

 <div class="create-form">
    <form method="POST">
        <!--  General -->
        <div class="form-group">
            <h2 class="section-headline">PUBLIC DETAILS</h2>

            <div>
                <label for="title">Title</label>
                <input type="text" placeholder="Accounts Name ..." id="title" name="title" />
            </div>


            <div>
                <label for="price">Price<small>($)</small></label>
                <input type="text" placeholder="Product Cost..." id="price" name="price" />
            </div>


            <div>
                <label for="delivery_type">Delivery Type</label>
                <select name="delivery_type" id="delivery_type">
                    <option value="instant" selected>Instant</option>
                    <option value="preorder">Preorder</option>
                </select>
            </div>


            <div class="hidden" id="delivery_period_container">
                <label for="delivery_period">Delivery Period</label>
                <select name="delivery_period" id="delivery_period">
                    <option value="1d" selected>24H</option>
                    <option value="2d">48H</option>
                </select>
            </div>

            <div>
                <label for="account_type">Account Type</label>
                <select name="account_type" id="account_type">
                    <option value="personal" selected>Personal
                    </option>
                    <option value="business">Business
                    </option>
                </select>
            </div>

            <div>
                <label for="country">Country</label>
                <select name="country" id="country">
                    @foreach (config('country') as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label for="description">Description</label>
                <textarea rows=5 type="text" placeholder="was created 5 years ago..." id="description" name="description"></textarea>
            </div>

        </div>


        <div class="form-group" id="private_data_container">
            <h2 class="section-headline">PRIVATE DETAILS <small>Only shared with Clients after the purchase process is
                    completed</small></h2>

            <div>
                <label for="account_details">Account Private Details</label>
                <textarea rows=5 type="text" placeholder="Username: aaa, Password: bbb, Login Link: xxxx..." id="account_details"
                    name="account_details"></textarea>
            </div>
        </div>

        <input type="submit" value="CREATE">

    </form>

