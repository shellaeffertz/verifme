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
                <label for="product_type">Type</label>
                <select name="product_type" id="product_type">
                    <option value="rdp" selected>RDP</option>
                    <option value="vps">VPS</option>
                </select>
            </div>

            <div>
                <label for="platform">Platform</label>
                <input type="text" placeholder="Azure, AWS..." id="platform" name="platform" />
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
            <h2 class="section-headline">PRIVATE DETAILS <small>Only shared with Clients after the purchase process is completed</small></h2>

            <div>
                <label for="ip">IP Adresse</label>
                <input type="text" placeholder="127.0.0.1.." id="ip" name="ip" />
            </div>

            <div>
                <label for="username">Username</label>
                <input type="text" placeholder="jhonDoe..." id="username" name="username" />
            </div>

            <div>
                <label for="password">Password</label>
                <input type="text" placeholder="123123..." id="password" name="password" />
            </div>

            <div>
                <label for="documents">Documents and extra details</label>
                <textarea rows=5 type="text" placeholder="Passport link: xxx..." id="documents" name="documents"></textarea>
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

            <div>
                <label for="document_links">PRIVATE LINKS</label>
                <textarea rows=5 type="text" placeholder="Documents Link  , Nox Profile ... " id="document_links"
                    name="document_links"></textarea>
            </div>

        </div>

        <input type="submit" value="CREATE">

    </form>
