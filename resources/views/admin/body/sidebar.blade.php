 <div class="vertical-menu">

     <div data-simplebar class="h-100">

         <!-- User details -->


         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title">Menu</li>

                 <li>
                     <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                         <i class="ri-dashboard-line"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <hr>

                 {{-- @if (Auth::user()->can('customer.menu')) --}}
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-user-3-line"></i>
                             <span>Manage Customer</span>
                         </a>

                         <ul class="sub-menu" aria-expanded="true">
                             @if (Auth::user()->can('corporate.list'))
                                 <li>
                                     <a href="{{ route('all.company') }}" class="waves-effect">
                                         <i class="ri-user-3-line"></i> <span>Customer</span>
                                     </a>
                                 </li>
                             @endif

                             {{-- @if (Auth::user()->can('local.list'))
                                 <li>
                                     <a href="{{ route('all.customer') }}" class="waves-effect">
                                         <i class="ri-user-3-line"></i> <span>Local</span>
                                     </a>
                                 </li>
                             @endif --}}
                         </ul>
                     </li>
                     <hr>
                 {{-- @endif --}}

                 @if (Auth::user()->can('product.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-product-hunt-line"></i>
                             <span>Manage Product</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">

                             @if (Auth::user()->can('unit.list'))
                                 <li>
                                     <a href="{{ route('unit.all') }}" class="waves-effect">
                                         <i class="ri-community-line"></i>
                                         <span>Manage Unit</span>
                                     </a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('category.list'))
                                 <li>
                                     <a href="{{ route('category.all') }}" class="waves-effect">
                                         <i class="ri-list-check"></i>
                                         <span>Category Setup</span>
                                     </a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('subcategory.list'))
                                 <li>
                                     <a href="{{ route('product.all') }}" class="waves-effect">
                                         <i class="ri-play-list-add-fill"></i>
                                         <span>Product Setup</span>
                                     </a>
                                 </li>
                             @endif

                         </ul>
                     </li>
                     <hr>
                 @endif

                 @if (Auth::user()->can('sale.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-file-chart-line"></i>
                             <span>Manage Sale</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">

                             @if (Auth::user()->can('bill.corporate.list'))
                                 <li><a href="{{ route('invoice.all') }}"><i class="ri-arrow-right-line"></i>All
                                         Bill</a></li>
                             @endif

                             @if (Auth::user()->can('wastes.bill.list'))
                                 <li><a href="{{ route('all.wastes.sale') }}"> <i class="ri-arrow-right-line"></i>All
                                         Wastage Sale</a>
                                 </li>
                             @endif
                         </ul>
                     </li>

                     <hr>
                 @endif
                 
                  <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-file-list-line"></i>
                            <span>Ledger Setup</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('customer.ledger.list') }}"><i class="ri-arrow-right-line"></i>
                                    Customer Ledger</a>
                            </li>
                            <li>
                                 <a href="{{ route('due.bill.ledger') }}"><i class="ri-arrow-right-line"></i>
                                 Due Bill Ledger</a>
                            </li>
                        </ul>
                   </li>
                   <hr>

                 @if (Auth::user()->can('invoice.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-file-text-line"></i>
                             <span>Manage Invoice</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="false">

                             @if (Auth::user()->can('daily.invoice.report.submenu'))
                                 <li><a href="{{ route('daily.invoice.report') }}"><i
                                             class="ri-arrow-right-line"></i>Daily
                                         Invoice Report</a>
                             @endif
                         </ul>
                     </li>
                     <hr>
                 @endif

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-file-text-line"></i>
                         <span>Manage Vat Chalan</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('vat.chalan.all') }}"><i class="ri-arrow-right-line"></i>
                                 Vat Chalan All</a>
                     </ul>
                 </li>
                 <hr>

                 @if (Auth::user()->can('employee.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-user-line"></i>
                             <span>Manage Employee</span>
                         </a>

                         <ul class="sub-menu" aria-expanded="false">
                             @if (Auth::user()->can('employee.list'))
                                 <li><a href="{{ route('all.employee') }}"><i class="ri-arrow-right-line"></i>All
                                         Employee</a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('employee.add'))
                                 <li><a href="{{ route('add.employee') }}"><i class="ri-arrow-right-line"></i>Add
                                         Employee</a>
                                 </li>
                             @endif
                         </ul>
                     </li>
                     <hr>
                 @endif

                 @if (Auth::user()->can('salary.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-bank-line"></i>
                             <span>Manage Salary</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             @if (Auth::user()->can('advanced.salary.list'))
                                 <li>
                                     <a href="{{ route('all.advanced.salary') }}">
                                         <i class="ri-arrow-right-line"></i>All Advanced
                                     </a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('pay.salary'))
                                 <li>
                                     <a href="{{ route('pay.salary') }}">
                                         <i class="ri-arrow-right-line"></i>Pay Salary
                                     </a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('overtime.salary.list'))
                                 <li>
                                     <a href="{{ route('all.overtime') }}">
                                         <i class="ri-arrow-right-line"></i>All Overtime
                                     </a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('bonus.list'))
                                 <li>
                                     <a href="{{ route('all.bonus') }}">
                                         <i class="ri-arrow-right-line"></i>All Bonus
                                     </a>
                                 </li>
                             @endif
                         </ul>
                     </li>
                     <hr>
                 @endif

                 @if (Auth::user()->can('purchase.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-bank-card-line"></i>
                             <span>Manage Purchase</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="false">
                             @if (Auth::user()->can('purchase.list'))
                                 <li>
                                     <a href="{{ route('all.purchase') }}"><i class="ri-arrow-right-line"></i>All
                                         Purchase</a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('purchase.add'))
                                 <li><a href="{{ route('add.purchase') }}"><i class="ri-arrow-right-line"></i>Add
                                         Purchase</a>
                                 </li>
                             @endif
                         </ul>
                     </li>
                     <hr>
                 @endif


                 @if (Auth::user()->can('account.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-account-box-line"></i>
                             <span>Manage Account</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             @if (Auth::user()->can('expense.submenu'))
                                 <li>
                                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                                         <i class="ri-bank-card-line"></i>
                                         <span>Expense</span>
                                     </a>
                                     <ul class="sub-menu" aria-expanded="true">
                                         @if (Auth::user()->can('expense.list'))
                                             <li>
                                                 <a href="{{ route('all.expense') }}">
                                                     <i class="ri-arrow-right-line"></i>
                                                     All Expense
                                                 </a>
                                             </li>
                                         @endif

                                         @if (Auth::user()->can('expense.add'))
                                             <li>
                                                 <a href="{{ route('add.expense') }}">
                                                     <i class="ri-arrow-right-line"></i>
                                                     Add Expense
                                                 </a>
                                             </li>
                                         @endif
                                     </ul>
                                 </li>
                             @endif


                             @if (Auth::user()->can('profit.calculate.submenu'))
                                 <li>
                                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                                         <i class="ri-bank-card-line"></i>
                                         <span>Profit Calculate</span>
                                     </a>
                                     <ul class="sub-menu" aria-expanded="true">
                                         <li><a href="{{ route('add.profit') }}"><i class="ri-arrow-right-line"></i>
                                                 Calculate</a></li>
                                     </ul>
                                 </li>
                             @endif
                         </ul>
                     </li>
                     <hr>
                 @endif

                 @if (Auth::user()->can('report.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-folder-chart-line"></i>
                             <span>Manage Report</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             @if (Auth::user()->can('category.report'))
                                 <li>
                                     <a href="{{ route('category.report') }}" class="waves-effect">
                                         <i class="ri-arrow-right-line"></i>
                                         <span>Category Report</span>
                                     </a>
                                 </li>
                             @endif

                             @if (Auth::user()->can('category.summery'))
                                 <li>
                                     <a href="{{ route('get.cat.report.summary') }}">
                                         <i class="ri-arrow-right-line"></i>Category Summery</a>
                                 </li>
                             @endif
                         </ul>
                     </li>
                     <hr>
                 @endif

                 @if (Auth::user()->can('role.permission.menu'))
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="ri-lock-line"></i>
                             <span>Role & Permission</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             @if (Auth::user()->can('all.permission'))
                                 <li>
                                     <a href="{{ route('all.permission') }}" class="waves-effect">
                                         <i class="ri-arrow-right-line"></i>
                                         <span>All Permission</span>
                                     </a>
                                 </li>
                             @endif
                             @if (Auth::user()->can('all.role'))
                                 <li>
                                     <a href="{{ route('all.role') }}">
                                         <i class="ri-arrow-right-line"></i>All Role</a>
                                 </li>
                             @endif
                             @if (Auth::user()->can('role.permission.list'))
                                 <li>
                                     <a href="{{ route('all.role.permission') }}">
                                         <i class="ri-arrow-right-line"></i>All Role Permission</a>
                                 </li>
                             @endif
                         </ul>
                     </li>
                     <hr>
                 @endif

                @if (Auth::user()->can('admin.menu'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>Admin Manage</span>
                        </a>
                        <ul>
                            @if (Auth::user()->can('admin.list'))
                                <li>
                                    <a href="{{ route('all.admin') }}">
                                        <i class="ri-arrow-right-line"></i>All Admin
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <hr>
                @endif

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-settings-2-line"></i>
                         <span>Openning Setup</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="true">
                         <li>
                             <a href="{{ route('add.customer.opening.ledger') }}" class="waves-effect">
                                 <i class="ri-arrow-right-line"></i>
                                 <span>Customer</span>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <hr>

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-settings-2-line"></i>
                         <span>Settings</span>
                     </a>
                     <ul>
                         <li>
                             <a href="{{ route('all.tax') }}">
                                 <i class="ri-arrow-right-line"></i>Tax list
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('site.setting') }}" class="waves-effect">
                                 <i class="ri-arrow-right-line"></i>
                                 <span>Site Setting</span>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <hr>

             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>
