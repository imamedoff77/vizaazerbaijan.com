<template>
  <nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">
      <NuxtLink to="/" class="navbar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 36 36">
          <!-- Icon from Twitter Emoji by Twitter - https://creativecommons.org/licenses/by/4.0/ -->
          <path fill="#E00034" d="M0 13h36v10H0z"/>
          <path fill="#0098C3" d="M32 5H4a4 4 0 0 0-4 4v4h36V9a4 4 0 0 0-4-4z"/>
          <g fill="#FFF">
            <path
                d="M17.844 21.333a3.333 3.333 0 1 1 2.475-5.565a4 4 0 1 0 .001 4.464a3.325 3.325 0 0 1-2.476 1.101z"/>
            <path
                d="M23.667 17.998l-1.196-.424l.544-1.146l-1.146.545l-.426-1.195l-.424 1.196l-.003-.002l-1.144-.542l.546 1.146l-1.196.426l1.196.424l-.544 1.146l1.141-.543l.005-.002l.426 1.195l.424-1.196l1.147.544l-.546-1.146z"/>
          </g>
          <path fill="#00AE65" d="M4 31h28a4 4 0 0 0 4-4v-4H0v4a4 4 0 0 0 4 4z"/>
        </svg>
        <span>Visa Azerbaijan</span>
      </NuxtLink>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
              aria-controls="offcanvasNavbar">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
          <!-- Icon from HeroIcons by Refactoring UI Inc - https://github.com/tailwindlabs/heroicons/blob/master/LICENSE -->
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5"/>
        </svg>
      </button>
      <div class="collapse navbar-collapse" id="mainNavbarContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <NuxtLink to="/" class="nav-link" exact-active-class="active" aria-current="page">Home</NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/eligible-countries/" exact-active-class="active" class="nav-link">Eligible Countries
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/requirements/" exact-active-class="active" class="nav-link">Requirements</NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/check-status/" exact-active-class="active" class="nav-link">Check Status</NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/contact/" exact-active-class="active" class="nav-link">Contact</NuxtLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start main-sidebar" tabindex="-1" id="offcanvasNavbar"
       aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 36 36">
          <!-- Icon from Twitter Emoji by Twitter - https://creativecommons.org/licenses/by/4.0/ -->
          <path fill="#E00034" d="M0 13h36v10H0z"/>
          <path fill="#0098C3" d="M32 5H4a4 4 0 0 0-4 4v4h36V9a4 4 0 0 0-4-4z"/>
          <g fill="#FFF">
            <path
                d="M17.844 21.333a3.333 3.333 0 1 1 2.475-5.565a4 4 0 1 0 .001 4.464a3.325 3.325 0 0 1-2.476 1.101z"/>
            <path
                d="M23.667 17.998l-1.196-.424l.544-1.146l-1.146.545l-.426-1.195l-.424 1.196l-.003-.002l-1.144-.542l.546 1.146l-1.196.426l1.196.424l-.544 1.146l1.141-.543l.005-.002l.426 1.195l.424-1.196l1.147.544l-.546-1.146z"/>
          </g>
          <path fill="#00AE65" d="M4 31h28a4 4 0 0 0 4-4v-4H0v4a4 4 0 0 0 4 4z"/>
        </svg>
        <span>Visa Azerbaijan</span>
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="menu">
        <li class="nav-item">
          <NuxtLink to="/" class="nav-link active" aria-current="page">Home</NuxtLink>
        </li>
        <li class="nav-item">
          <NuxtLink to="/eligible-countries/" class="nav-link">Eligible Countries</NuxtLink>
        </li>
        <li class="nav-item">
          <NuxtLink to="/requirements/" class="nav-link">Requirements</NuxtLink>
        </li>
        <li class="nav-item">
          <NuxtLink to="/check-status/" class="nav-link">Check Status</NuxtLink>
        </li>
        <li class="nav-item">
          <NuxtLink to="/contact/" class="nav-link">Contact</NuxtLink>
        </li>
      </ul>
    </div>
  </div>
</template>
