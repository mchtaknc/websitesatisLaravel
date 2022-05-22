<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <span class="brand-text font-weight-light">Yönetim Paneli</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Sayfa Yönetimi</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-alt"></i>
              <p>
                Sayfalar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Sayfa Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Sayfa Ekle</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Paket Yönetimi</li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.packages','admin.packages.create','admin.packages.edit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['admin.packages','admin.packages.create','admin.packages.edit']) ? 'active' : '' }}">
              <i class="nav-icon fa fa-box"></i>
              <p>
                Paketler
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.packages') }}" class="nav-link {{ Route::currentRouteName() == 'admin.packages' ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Paket Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.packages.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.packages.create' ? 'active' : '' }}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Paket Ekle</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Tema Yönetimi</li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.themes.category','admin.themes.category.create','admin.themes.category.edit','admin.themes','admin.themes.create','admin.themes.edit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['admin.themes.category','admin.themes.category.create','admin.themes.category.edit','admin.themes','admin.themes.create','admin.themes.edit']) ? 'active' : '' }}">
              <i class="nav-icon fa fa-file-alt"></i>
              <p>
                Temalar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.themes') }}" class="nav-link {{ Route::currentRouteName() == 'admin.themes' ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Tema Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.themes.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.themes.create' ? 'active' : '' }}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Tema Ekle</p>
                </a>
              </li>
              <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.themes.category','admin.themes.category.create','admin.themes.category.edit']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="fa fa-sitemap nav-icon"></i>
                  <p>
                    Tema Kategorileri
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.themes.category') }}" class="nav-link {{ Route::currentRouteName() == 'admin.themes.category' ? 'active' : '' }}">
                      <i class="fa fa-list nav-icon"></i>
                      <p>Kategori Listesi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.themes.category.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.themes.category.create' ? 'active' : '' }}">
                      <i class="fa fa-plus nav-icon"></i>
                      <p>Kategori Ekle</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-header">Sipariş Yönetimi</li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.orders','admin.orders.create','admin.orders.edit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['admin.orders','admin.orders.create','admin.orders.edit']) ? 'active' : '' }}">
              <i class="nav-icon fa fa-shopping-basket"></i>
              <p>
                Siparişler
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href={{route('admin.orders')}} class="nav-link {{ Route::currentRouteName() == 'admin.orders' ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Sipariş Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.orders.create')}}" class="nav-link {{ Route::currentRouteName() == 'admin.orders.create' ? 'active' : '' }}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Sipariş Ekle</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Müşteri Yönetimi</li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.customers','admin.customers.create','admin.customers.edit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['admin.customers','admin.customers.create','admin.customers.edit']) ? 'active' : '' }}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Müşteriler
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.customers') }}" class="nav-link {{ Route::currentRouteName() == 'admin.customers' ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Müşteri Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.customers.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.customers.create' ? 'active' : '' }}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Müşteri Ekle</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Kullanıcı Yönetimi</li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.users','admin.users.create','admin.users.edit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['admin.users','admin.users.create','admin.users.edit']) ? 'active' : '' }}">
              <i class="nav-icon fa fa-user-friends"></i>
              <p>
                Kullanıcılar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Kullanıcı Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.users.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.users.create' ? 'active' : '' }}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Kullanıcı Ekle</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Sistem Yönetimi</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Ayarlar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>