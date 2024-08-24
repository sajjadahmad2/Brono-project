  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!--begin::Chart widget 28-->
      <div class="card card-flush h-xl-100">
          <!--begin::Header-->
          <div class="card-header py-7">
              <!--begin::Statistics-->
              <div class="m-0">
                  <!--begin::Heading-->
                  <div class="d-flex align-items-center mb-2">
                      <!--begin::Title-->
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_contacts"
                          id="total_contacts">0</span>
                      <!--end::Title-->
                  </div>
                  <!--end::Heading-->

                  <!--begin::Description-->
                  <span class="fs-6 fw-semibold text-gray-500">Total Contacts</span>
                  <!--end::Description-->
              </div>
              <!--end::Statistics-->

              <!--begin::Toolbar-->
              <div class="card-toolbar">
                  <!--begin::Menu-->
                  {{-- <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
                            </button> --}}

                  {{-- font awesome --}}
                  <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                      data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                      <i class="fas fa-ellipsis-h fs-1 text-gray-500 me-n1"></i>
                  </button>


                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                      data-kt-menu="true">
                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu separator-->
                      <div class="separator mb-3 opacity-75"></div>
                      <!--end::Menu separator-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">
                              New Ticket
                          </a>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">
                              New Customer
                          </a>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                          <!--begin::Menu item-->
                          <a href="#" class="menu-link px-3">
                              <span class="menu-title">New Group</span>
                              <span class="menu-arrow"></span>
                          </a>
                          <!--end::Menu item-->

                          <!--begin::Menu sub-->
                          <div class="menu-sub menu-sub-dropdown w-175px py-4">
                              <!--begin::Menu item-->
                              <div class="menu-item px-3">
                                  <a href="#" class="menu-link px-3">
                                      Admin Group
                                  </a>
                              </div>
                              <!--end::Menu item-->

                              <!--begin::Menu item-->
                              <div class="menu-item px-3">
                                  <a href="#" class="menu-link px-3">
                                      Staff Group
                                  </a>
                              </div>
                              <!--end::Menu item-->

                              <!--begin::Menu item-->
                              <div class="menu-item px-3">
                                  <a href="#" class="menu-link px-3">
                                      Member Group
                                  </a>
                              </div>
                              <!--end::Menu item-->
                          </div>
                          <!--end::Menu sub-->
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">
                              New Contact
                          </a>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu separator-->
                      <div class="separator mt-3 opacity-75"></div>
                      <!--end::Menu separator-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <div class="menu-content px-3 py-3">
                              <a class="btn btn-primary  btn-sm px-4" href="#">
                                  Generate Reports
                              </a>
                          </div>
                      </div>
                      <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->

                  <!--end::Menu-->
              </div>
              <!--end::Toolbar-->
          </div>
          <!--end::Header-->

          <!--begin::Body-->
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <!--begin::Chart-->
              <div id="contact_datewise" class="h-300px w-100 min-h-auto" style="min-height: 315px;">

              </div>
              <!--end::Chart-->
          </div>
          <!--end::Body-->
      </div>
      <!--end::Chart widget 28-->
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!--begin::Chart widget 28-->
      <div class="card card-flush h-xl-100">
          <!--begin::Header-->
          <div class="card-header py-7">
              <!--begin::Statistics-->
              <div class="m-0">
                  <!--begin::Heading-->
                  <div class="d-flex align-items-center mb-2">
                      <!--begin::Title-->
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_contacts" id="total_tags">0</span>
                      <!--end::Title-->
                  </div>
                  <!--end::Heading-->

                  <!--begin::Description-->
                  <span class="fs-6 fw-semibold text-gray-500">Contacts By Assigned User</span>
                  <!--end::Description-->
              </div>
              <!--end::Statistics-->

              <!--begin::Toolbar-->
              <div class="card-toolbar">
                  <!--begin::Menu-->
                  {{-- font awesome --}}
                  <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                      data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                      <i class="fas fa-ellipsis-h fs-1 text-gray-500 me-n1"></i>
                  </button>


                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                      data-kt-menu="true">
                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu separator-->
                      <div class="separator mb-3 opacity-75"></div>
                      <!--end::Menu separator-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">
                              New Ticket
                          </a>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">
                              New Customer
                          </a>
                      </div>
                      <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->

                  <!--end::Menu-->
              </div>
              <!--end::Toolbar-->
          </div>
          <!--end::Header-->

          <!--begin::Body-->
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <!--begin::Chart-->
              <div id="contactsassignedchart" class="h-300px w-100 min-h-auto" style="min-height: 315px;">

              </div>
              <!--end::Chart-->
          </div>
          <!--end::Body-->
      </div>
      <!--end::Chart widget 28-->


  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Total Opportunities -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 " id="total_opportunities">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Group By Countries</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="group_by_countries" class="h-300px w-100 min-h-auto" style="min-height: 315px;"></div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!--begin::Chart widget 28-->
      <div class="card card-flush h-xl-100">
          <!--begin::Header-->
          <div class="card-header py-7">
              <!--begin::Statistics-->
              <div class="m-0">
                  <!--begin::Heading-->
                  <div class="d-flex align-items-center mb-2">
                      <!--begin::Title-->
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_contacts"
                          id="">0</span>
                      <!--end::Title-->
                  </div>
                  <!--end::Heading-->

                  <!--begin::Description-->
                  <span class="fs-6 fw-semibold text-gray-500">Contacts By Tags</span>
                  <!--end::Description-->
              </div>
              <!--end::Statistics-->

              <!--begin::Toolbar-->
              <div class="card-toolbar">
                  <!--begin::Menu-->
                  {{-- font awesome --}}
                  <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                      data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                      <i class="fas fa-ellipsis-h fs-1 text-gray-500 me-n1"></i>
                  </button>


                  <!--begin::Menu 2-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                      data-kt-menu="true">
                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu separator-->
                      <div class="separator mb-3 opacity-75"></div>
                      <!--end::Menu separator-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">
                              New Ticket
                          </a>
                      </div>
                      <!--end::Menu item-->

                      <!--begin::Menu item-->
                      <div class="menu-item px-3">
                          <a href="#" class="menu-link px-3">
                              New Customer
                          </a>
                      </div>
                      <!--end::Menu item-->
                  </div>
                  <!--end::Menu 2-->

                  <!--end::Menu-->
              </div>
              <!--end::Toolbar-->
          </div>
          <!--end::Header-->

          <!--begin::Body-->
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <!--begin::Chart-->
              <div id="grouped_contacts_by_tags" class="h-300px w-100 min-h-auto" style="min-height: 315px;">

              </div>
              <!--end::Chart-->
          </div>
          <!--end::Body-->
      </div>
      <!--end::Chart widget 28-->
  </div>
  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Total Opportunities -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 " id="total_opportunities">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Total Opportunities</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="daywise_count_chart" class="h-300px w-100 min-h-auto" style="min-height: 315px;"></div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Total Opportunities -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 "
                          id="total_opportunities_conversion">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Total Conversions</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="lead_to_sale_count_chart" class="h-300px w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Pipelines Wise -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="pipelines_wise">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Pipelines Wise Opportunities</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="pipelines_wise_chart" class=" w-100 min-h-auto" style="min-height: 315px;"></div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Opportunities by Status -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="opportunities_by_status">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Opportunities by Status</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="opportunities_by_status_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Monetary Value Distribution -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="monetary_value_distribution">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Monetary Value Distribution</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="monetary_value_distribution_chart" class="w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>



  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Opportunities Assigned Per User -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="opportunities_assigned_per_user">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Opportunities Assigned Per User</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="opportunities_assigned_per_user_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>


  {{-- Appointments Charts --}}
  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Appointments by Source -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="total_appointments">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Total Appointments </span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="appointment_by_daywise" class=" w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Appointments by Source -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="appointments_by_source">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Appointments By Source</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="appointments_by_source_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Appointments by Status -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="appointments_by_status">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Appointments By Status</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="appointments_by_status_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Appointments Assigned Per User -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="appointments_assigned_per_user">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Appointments Assigned Per User</span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="appointments_assigned_per_user_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>

  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Appointments Assigned Per User -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_opportunities"
                          id="appointments_assigned_per_user">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500"> Appointments Calendar Wise </span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="appointments_calendar_wise_chart" class=" w-100 min-h-auto" style="min-height: 315px;">
              </div>
          </div>
      </div>
  </div>

  {{-- calls chart --}}
  <div class="col-xxl-4 mb-5 mb-xl-10">
      <!-- Calls by Source -->
      <div class="card card-flush h-xl-100">
          <div class="card-header py-7">
              <div class="m-0">
                  <div class="d-flex align-items-center mb-2">
                      <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 " id="total_calls">0</span>
                  </div>
                  <span class="fs-6 fw-semibold text-gray-500">Total Calls </span>
              </div>
          </div>
          <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
              <div id="calls_by_daywise" class=" w-100 min-h-auto" style="min-height: 315px;"></div>
          </div>
      </div>
  </div>
