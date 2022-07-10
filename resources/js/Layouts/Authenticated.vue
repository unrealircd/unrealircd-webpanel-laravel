<template>
    <nav class="navbar py-2 navbar-dark sticky-top navbar-expand-lg bg-dark py-1 shadow">
        <a class="navbar-brand bg-dark col-md-3 col-lg-2 me-0 px-5 fs-6" href="#">{{ $page.props.app.name }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="w-100 px-3 d-flex align-items-center justify-content-between">
            <div class="text-white">{{ __('Hi') }}, {{ $page.props.user?.name ?? __('IRC User') }}</div>
            <div class="">
                <a class="link text-white text-decoration-none" href="#">{{ __('Sign out') }}</a>
            </div>
        </div>
    </nav>

    <div class="">
        <b-nav tag="div" vertical class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('dashboard')" :active="route().current('dashboard')">
                {{ __('Dashboard') }}
            </x-link>
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('users')" :active="route().current('users')">
                {{ __('Users') }}
            </x-link>
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('channels')" :active="route().current('channels')">
                {{ __('Channels') }}
            </x-link>
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('bans')" :active="route().current('bans')">
                {{ __('Bans') }}
            </x-link>
        </b-nav>

        <main class="col-md-9 ms-sm-auto col-lg-10">
            <b-alert variant="danger" class="rounded-0 border-0 bg-danger text-white mb-0" show>
                {{ __('Debug Mode is currently enabled.') }}
            </b-alert>
            <div class="container-fluid px-md-4">
                <slot/>
            </div>
        </main>

        <b-container :toast="{root:true}" class="topper" fluid="sm" position="position-sticky" />
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    data() {
        return {
            __: window.__,
        }
    }
})
</script>

<style scoped lang="scss">
.sidebar {
    position: fixed;
    top: 1px;
    bottom: 0;
    left: 0;
    z-index: 1; /* Behind the navbar */
    padding: 48px 0 0; /* Height of navbar */
}

@media (max-width: 767.98px) {
    .sidebar {
        top: 5rem;
    }
}

.nav-item {
    margin: .4rem;
    font-weight: 500;
    color: #333 !important;
    display: block;
    padding: .725rem .925rem;
    text-decoration: none;
    border-radius: .325rem;

    &:hover {
        background: #3399ff77;
    }
}

.nav-item.active {
    color: #fff !important;
    background: #3399ff;
}

.sidebar-heading {
    font-size: .75rem;
}

/*
 * Navbar
 */

.navbar-brand {
    background-color: #212529;
    z-index: 100;
    height: 32px;
}

.navbar .navbar-toggler {
    top: .25rem;
    right: 1rem;
}

.navbar .form-control {
    padding: .75rem 1rem;
}

.form-control-dark {
    color: #fff;
    background-color: rgba(255, 255, 255, .1);
    border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
    border-color: transparent;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}

.link:hover {
    color: #d8ddd8 !important;
}
</style>
