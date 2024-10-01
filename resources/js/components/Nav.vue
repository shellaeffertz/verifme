<template>
    <div class="nav">
        <div class="logo">
            <RouterLink  to="/">
                <img src="../assets/logo.png" alt="Vue Mastery Logo">
            </RouterLink>
        </div>

        <div class="nav-content">
            <div class="nav-list">
                <div class="nav-list-title">
                    Admin
                </div>
                <div class="nav-list-items">
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/dashboard.svg" alt="Dashboard Icon">
                        Dashboard
                    </RouterLink>
                    <RouterLink class="link" to="/">

                        <img src="../assets/icons/users.svg" alt="users" />
                        Users
                    </RouterLink>
                    <RouterLink class="link" to="/profile">
                        <img src="../assets/icons/transations.svg" alt="transactions" />
                        Transactions
                    </RouterLink>
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/products.svg" alt="products" />
                        Products
                    </RouterLink>
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/withdraws.svg" alt="withdraw" />
                        Withdraws
                    </RouterLink>
                </div>
            </div>

            <div class="nav-list">
                <div class="nav-list-title">
                    Seller
                </div>
                <div class="nav-list-items">
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/dashboard.svg" alt="dashboard" />
                        Dashboard
                    </RouterLink>
                    <RouterLink class="link" to="/profile">
                        <img src="../assets/icons/products.svg" alt="products" />
                        My Products
                    </RouterLink>
                </div>
            </div>
            <div class="nav-list">
                <div class="nav-list-title">
                    Products
                </div>
                <div class="nav-list-items">
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/banks.svg" alt="banks" />
                        Banks
                    </RouterLink>
                    <RouterLink class="link" to="/profile">
                        <img src="../assets/icons/gateways.svg" alt="gateways" />
                        Gateways
                    </RouterLink>
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/wallets.svg" alt="wallets" />
                        Wallets
                    </RouterLink>
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/tools.svg" alt="leads" />
                        Tools
                    </RouterLink>
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/hosting.svg" alt="leads" />
                        Hosting
                    </RouterLink>
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/leads.svg" alt="leads" />
                        Send
                    </RouterLink>
                    <RouterLink class="link" to="/">
                        <img src="../assets/icons/leads.svg" alt="leads" />
                        Leads
                    </RouterLink>
                </div>
            </div>

            <div class="bottom-items">
                <RouterLink class="bottom-link" to="/">
                    <img src="../assets/icons/settings.svg" alt="settings" />
                    Settings
                </RouterLink>
                <a class="bottom-link" href="/logout">
                    <img src="../assets/icons/logout.svg" alt="logout" />
                    Logout
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>
.nav {
    width: min(15rem, 100%);
    min-height: 100vh;
    padding: 1rem 1rem;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
}
.link {
    color: #000000;
    text-decoration: none;
    font-size: .85rem;
    font-weight: 400;
    display: flex;
    padding: .60rem 1rem;
    align-items: center;
    color: #576CBC;
    width: 100%;
}

.link:hover {
    color: #19376D;
    background-color: #A5D7E8;
    border-radius: .66rem;
}

.bottom-link {
    color: #A5D7E8;
    text-decoration: none;
    font-size: .85rem;
    font-weight: 400;
    display: flex;
    padding: .6rem;
    align-items: center;
    color: #576CBC;
    width: 100%;
}

.bottom-link:hover {
    color: #19376D;
    background-color: #A5D7E8;
    border-radius: .66rem;
}

.bottom-link img {
    margin-right: .5rem;
    width: 1.25rem;
    height: 1.25rem;
}

.nav-content {
    display: flex;
    flex-direction: column;
    min-height: calc(100vh - 40px - 2.25rem);
    align-items: stretch;
}

.bottom-items {
    margin-top: auto;
}

.link img {
    margin-right: .5rem;
    width: 1.5rem;
    height: 1.5rem;
}
.nav-list-title {
    font-size: .75rem;
    font-weight: 300;
    margin: .5rem 0;
    text-transform: uppercase;
    color: rgb(105, 66, 139);
}

.nav-list-items {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    height: 100%;
}

.logo {
    width: 40px;
    margin: 0 auto;
}

</style>