<!DOCTYPE html>
<html>
  @include('admin.templates.partials._head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.templates.partials._header')
    
    @include('admin.templates.partials._aside')

  <div class="content-wrapper">
    <section class="content">
      @yield('content')
    </section>
  </div>

  @include('admin.templates.partials._footer')
  @include('admin.templates.partials._control-aside')

  <div class="control-sidebar-bg"></div>
</div>


@include('admin.templates.partials._script')

</body>
</html>
