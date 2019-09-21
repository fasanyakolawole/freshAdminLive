<template>
    <div>
      <h2 class='alert-info'>{{success}}</h2>
      <br/>
      <h4><a @click='fetchClients()' href='javascript:'>All Clients</a> / <a href='javascript:' @click='fetchCleaners()'>Active Cleaners</a>/ <a href='javascript:' @click='fetchInactiveCleaners()'>Inactive Cleaners</a>


      </h4>
    <table v-if="!moreInfoTab" class="table table-hover  table-bordered">
        <thead>
        <tr class='alert-info'>
            <th>Registration Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date Registered</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody>
        <tr class='alert-warning' v-for="x in orderedUsers" >
            <td @click="moreInfoTab=true"> {{ x.id }} </td>
            <td @click="moreInfoTab=true">{{ x.name }}</td>
            <td @click="moreInfoTab=true">{{ x.email }}</td>
            <td @click="moreInfoTab=true">{{ x.created_at }}</td>
            <td><input @click='activateUser(x.id)' :checked='x.active' type='checkbox'></td>
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
            this.fetchClients();
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
            }
        },

        methods: {
            fetchClients: function (page=1) {
                axios.get("\clients?page="+page)
                    .then(response => {
                          console.log('function was called');
                          console.log(response.data[0].last_page);
                          this.pagination=response.data[0].last_page;
                          this.clientsInfo=response.data[0].data;
                          this.action = 'clients';
                    })
                    .catch(error =>{
                        console.log(error)
                    });
            },

            fetchCleaners: function (page=1) {
                axios.get("\cleaners?page="+page)
                    .then(response => {
                          console.log('function was called');
                          console.log(response.data[0].last_page);
                          this.pagination=response.data[0].last_page;
                          this.clientsInfo=response.data[0].data;
                          this.action = 'cleaners';
                    })
                    .catch(error =>{
                        console.log(error)
                    });
            },

            fetchInactiveCleaners: function (page=1) {
                axios.get("\inactiveCleaners?page="+page)
                    .then(response => {
                          console.log('function was called');
                          console.log(response.data[0].last_page);
                          this.pagination=response.data[0].last_page;
                          this.clientsInfo=response.data[0].data;
                          this.action = 'inactive';
                    })
                    .catch(error =>{
                        console.log(error)
                    });
            },

            activateUser: function (id) {
              console.log(id);
              axios.get("\activateCleaners?id="+id)
                  .then(response => {
                        this.success = response.data.response;
                  })
                  .catch(error =>{
                      console.log(error)
                  });
            },



            paginateRequest: function (nextPage){
               switch(this.action) {
                case "clients":
                   this.fetchClients(nextPage);
                  break;
                case "cleaners":
                  this.fetchCleaners(nextPage);
                  break;
                  case "inactive":
                    this.fetchInactiveCleaners(nextPage);
                    break;
                default:
                  //text = "I have never heard of that fruit...";
              }
            }
        }}
</script>
