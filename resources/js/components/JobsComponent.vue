<template>
    <div>
      <h2 class='alert-info'>{{success}}</h2>
      <br/>
      <h4><a @click='awaitingJobs()' href='javascript:'>Awaiting Jobs</a> / <a href='javascript:' @click='activeJobs()'>Active Jobs</a>/ <a href='javascript:' @click='cancledJobs()'>Cancled Jobs</a>
      / <a href='javascript:' @click='completedJobs()'>Completed Jobs</a>
      </h4>
    <table v-if="!moreInfoTab" class="table table-hover  table-bordered">
        <thead>
        <tr class='alert-info'>
            <th>Date</th>
            <th>Postcode</th>
            <th>Address</th>
            <th>Services</th>
            <th>Hours</th>
            <th>Mobile</th>
            <th>Charge</th>
            <th>Gain</th>
            <th nowrap>Cleaner's Take</th>
            <th>Cleaner</th>
            <th>Client</th>
            <th>Id</th>

        </tr>
        </thead>
        <tbody>
        <tr class='alert-warning' v-for="x in orderedUsers" >
            <td> {{ x.job_date }} </td>
            <td>{{ x.job_postcode }}</td>
            <td >{{ x.job_address }}</td>
            <td >{{ x.job_type }}</td>
            <td >{{ x.neededHours }}</td>
            <td >{{ x.mobile }}</td>
            <td >{{ x.total_charge }}</td>
            <td >{{ x.company_take }}</td>
            <td >{{ x.professional_take }}</td>
            <td >{{x.cleaners_id}}</td>
            <td >{{getName( x.client_id)}} </td>
            <td >{{ x.id }}</td>
        </tr>
        </tbody>
    </table>

        <div v-if="!moreInfoTab" align="center">
         <!--all paginations -->
            <ul class="pagination">
                <li  v-for="x in pagination"  @click="paginateRequest(x)">  <a href="#">{{x}}</a> </li>
            </ul>
        </div>

<!--more info tab more information about user-->
        <div v-if="moreInfoTab" class="well">
            <a href="javascript:"> <h4 style="background: black;color:white" @click="moreInfoTab=false">Back to list</h4></a>
            Name <br/> <br/>
            Date Registered  <br/> <br/>
            Jobs Done  <br/> <br/>
            Pending Transactions  <br/> <br/>
            Location  <br/> <br/>
            Attached Document  Identity  <br/> <br/>
            Attached Document  CRB document   <br/> <br/>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.awaitingJobs();
            console.log('Component mounted.')
        },
        data() {
            return {
                moreInfoTab: 0,
                clientsInfo: 0,
                getMoreClientData:0,
                pagination:0,
                action:null,
                success:null,
            }
        },
        props: [
            'postTitle'
        ],

        computed: {
            orderedUsers: function () {
                return _.orderBy(this.clientsInfo, '')
            },
        },

        methods: {
            awaitingJobs: function (page=1) {
                axios.get("\awaitingJobs?page="+page)
                    .then(response => {
                          console.log('function was called');
                          console.log(response.data[0].last_page);
                          this.pagination=response.data[0].last_page;
                          this.clientsInfo=response.data[0].data;
                          this.action = 'awaiting';
                    })
                    .catch(error =>{
                        console.log(error)
                    });
            },

            activeJobs: function (page=1) {
                axios.get("\activeJobs?page="+page)
                    .then(response => {
                          console.log('function was called');
                          console.log(response.data[0].last_page);
                          this.pagination=response.data[0].last_page;
                          this.clientsInfo=response.data[0].data;
                          this.action = 'active';
                    })
                    .catch(error =>{
                        console.log(error)
                    });
            },

            cancledJobs: function (page=1) {
                axios.get("\cancledJobs?page="+page)
                    .then(response => {
                          console.log('function was called');
                          console.log(response.data[0].last_page);
                          this.pagination=response.data[0].last_page;
                          this.clientsInfo=response.data[0].data;
                          this.action = 'cancled';
                    })
                    .catch(error =>{
                        console.log(error)
                    });
            },

            completedJobs: function (page=1) {
                axios.get("\completedJobs?page="+page)
                    .then(response => {
                          console.log('function was called');
                          console.log(response.data[0].last_page);
                          this.pagination=response.data[0].last_page;
                          this.clientsInfo=response.data[0].data;
                          this.action = 'completed';
                    })
                    .catch(error =>{
                        console.log(error)
                    });
            },

            getName: function (id) {
                 // axios.get("\getName?id="+id)
                 //     .then(response => {
                 //       this.success = response;
                 //     })
                 //     .catch(error =>{
                 //         console.log(error)
                 //     });
                 return id;
            },


            // activateUser: function (id) {
            //   console.log(id);
            //   axios.get("\activateCleaners?id="+id)
            //       .then(response => {
            //             this.success = response.data.response;
            //       })
            //       .catch(error =>{
            //           console.log(error)
            //       });
            // },
//completedJobs
            paginateRequest: function (nextPage){
               switch(this.action) {
                 case "awaiting":
                   this.awaitingJobs(nextPage);
                  break;
                 case "active":
                  this.activeJobs(nextPage);
                  break;
                 case "cancled":
                    this.cancledJobs(nextPage);
                    break;
                 case "completed":
                      this.completedJobs(nextPage);
                      break;
                default:
                  //text = "I have never heard of that fruit...";
              }
            }
        }}
</script>
