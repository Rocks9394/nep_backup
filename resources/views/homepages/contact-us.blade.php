@extends('layouts.app')
@section('content')

<style>
    a {
        color: orangered;
    }
        a:hover {
        color: orangered;
        text-decoration: underline;
    }

</style>

<div class="container">
    <div class="t-mrg2 pb-5">
        <div class="container-fluid p-0 pt-5">
            <!-- <div class="row">
                <div class="col">
                    <div class="heading-rw mt-0">
                        <h1>Central Team</h1>
                    </div>
                </div>
            </div> -->

            <div class="row my-5">

                <div class="col-md-12">
                    <h4 class="mt-3 mb-3">Technical Helpdesk</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="auto-style1">Cluster Name</th>
                                    <th style="width: 418px;">School States</th>
                                    <th>Helpdesk Email ID to Contact</th>
                                    <th>Helpdesk Mobile No to Call</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="auto-style1">Cluster 1</th>
                                    <td>Uttar Pradesh and Uttarakhand</td>
                                    <td><a href="mailto:fitness.cluster1@cisce.org">fitness.cluster1@cisce.org</a> </td>
                                   <!--  <td>7303225696</td> -->
                                    <td>7303225696</td>
                                </tr>

                                <tr>
                                    <th class="auto-style1">Cluster 2</th>
                                    <td>West Bengal, Arunachal Pradesh, Assam, Manipur, Meghalaya, Mizoram, Nagaland, Sikkim, Tripura and Odisha</td>
                                    <td><a href="mailto:fitness.cluster2@cisce.org">fitness.cluster2@cisce.org</a> </td>
                                    <td>7303323397</td>
                                </tr>

                                <tr>
                                    <th class="auto-style1">Cluster 3</th>
                                    <td>Delhi, Himachal Pradesh, Chandigarh, Haryana, Punjab, Jammu & Kashmir, Bihar, Jharkhand, Madhya Pradesh, Gujarat , Goa and Rajasthan</td>
                                    <td><a href="mailto:fitness.cluster3@cisce.org">fitness.cluster3@cisce.org</a> </td>
                                    <td>7303322098</td>
                                </tr>
                                <tr>
                                    <th class="auto-style1">Cluster 4</th>
                                    <td>Andhra Pradesh, Telangana,  Karnataka and Chhattisgarh</td>
                                    <td><a href="mailto:fitness.cluster4@cisce.org">fitness.cluster4@cisce.org</a> </td>
                                    <td>9910457600</td>
                                </tr>
                                <tr>
                                    <th class="auto-style1">Cluster 5</th>
                                    <td>Kerala, Maharashtra, Tamil Nadu, Puducherry, Andaman & Nicobar Island</td>
                                    <td><a href="mailto:fitness.cluster5@cisce.org">fitness.cluster5@cisce.org</a> </td>
                                    <td>9910457500</td>
                                </tr>
                            </tbody>
                        </table>
                        <p><strong>Timing:</strong> Mon–Fri, 9:00 AM–6:00 PM, except holidays</p>
                        <p><strong>Note:</strong> Helpdesks are state-specific. Kindly contact only your designated cluster personnel.</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <h4 class="mt-3">Escalation Protocol</h4>
                    <p>If your concern is not resolved within three (3) working days, you may escalate it to the relevant authority below:</p>
                    <table class="table table-bordered">
                        <thead>
                                <tr>
                                    <th class="auto-style1">Query Type</th>
                                    <th style="width: 418px;">Contact Person</th>
                                    <th>Mobile Number</th>
                                    <th>Email ID</th>
                                </tr>
                            </thead>
                        <tbody>                            
                            <tr>
                                <td class="auto-style2">Portal and Assessment Issues and Queries</td>
                                <td class="auto-style2">Mr. Sujit Panigrahi (CEO, Sequoia Fitness and Sports Technology Pvt Ltd)</td>
                                <td class="auto-style2">9810259395</td>
                                <td class="auto-style2"><a href="mailto:fitness.assessment@cisce.org">fitness.assessment@cisce.org</a></td>
                            </tr>
                            <tr>
                                <td class="auto-style2">Training Queries</td>
                                <td class="auto-style2">Mr. Arijit Basu (Deputy Secretary, Finance)</td>
                                <td class="auto-style2">9831133606</td>
                                <td class="auto-style2"><a href="mailto:fitness.training@cisce.org">fitness.training@cisce.org</a></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection