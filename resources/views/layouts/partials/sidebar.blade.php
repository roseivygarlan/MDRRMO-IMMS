  <!-- start sidebar -->
  <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">

    <!-- sidebar content -->
    <div class="flex flex-col">

      <div class="hidden md:block mb-4">
        <div class="flex-none w-56 flex flex-row items-center">
          <img src="{{asset('img/mdrrmo-bulan.png')}}" class="w-10 flex-none">
          <strong class="capitalize ml-1 flex-1">MDRRMO - IMMS</strong>
          <!-- sidebar toggle -->
          <button id="sideBarHideBtn">
            <i class="fad fa-times-circle"></i>
          </button>
        </div>
      </div>
     
      <!-- end sidebar toggle -->
      <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider"></p>
      @if(auth()->user()->type == '1001')
        @include('layouts.partials.user-sidebar')
      @elseif(auth()->user()->type == '1010')
        @include('layouts.partials.barangay-sidebar')
      @elseif(auth()->user()->type == '1111')
        @include('layouts.partials.admin-sidebar')
      @endif
    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->