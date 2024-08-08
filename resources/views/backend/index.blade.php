@extends('backend.master')
@section('content')


<div class="cards">
    <div class="card-single">
        <div>
            <h3>54</h3>
            <span>Users</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h3>79</h3>
            <span>Sales</span>
        </div>
        <div>
            <span class="las la-shopping-bag"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h3>124</h3>
            <span>Products</span>
        </div>
        <div>
            <span class="las la-clipboard-list"></span>
        </div>
    </div>
</div>

<div class="recent-grid">
    <div class="projects">
        <div class="card">
            <div class="card-header">
                <h3>Recent Projects</h3>
                <button>See all <span class="las la-arrow-right"></span></button>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Team</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Project 1</td>
                            <td>In Progress</td>
                            <td>July 20, 2024</td>
                            <td>John, Anna</td>
                        </tr>
                        <tr>
                            <td>Project 2</td>
                            <td>Completed</td>
                            <td>August 2, 2024</td>
                            <td>John, Mark</td>
                        </tr>
                        <tr>
                            <td>Project 3</td>
                            <td>Pending</td>
                            <td>September 12, 2024</td>
                            <td>Anna, Sara</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    <div class="customers">
        <div class="card">
            <div class="card-header">
                <h3>New Customers</h3>
                <button>See all <span class="las la-arrow-right"></span></button>
            </div>
            <div class="card-body">
                <div class="customer">
                    <img src="https://via.placeholder.com/30" alt="Customer">
                    <div>
                        <h4>Jane Doe</h4>
                        <small>Customer</small>
                    </div>
                </div>
                <div class="customer">
                    <img src="https://via.placeholder.com/30" alt="Customer">
                    <div>
                        <h4>Sam Smith</h4>
                        <small>Customer</small>
                    </div>
                </div>
                <div class="customer">
                    <img src="https://via.placeholder.com/30" alt="Customer">
                    <div>
                        <h4>Linda Adams</h4>
                        <small>Customer</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
