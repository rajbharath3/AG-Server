<script>
    app.controller('MainController', function($scope, $http) {
        var vm = this;
        vm.message = 'hello';
        vm.griddata = [];
        vm.pagingData = {
            requestedPage: 1,
            pageSize: 10,
            totalPages: 1,
            totalItems: 0,
            hasPrevPage: false,
            hasNextPage: false
        };
        vm.activate = activate;
        vm.fetchGridData = fetchGridData;
        vm.becomeUser = becomeUser;

        function activate() {
            console.log('hello');
            fetchGridData();
        }

        function fetchGridData() {
            $http.post('/superadmin/manageusers/jxFetchGridData', vm.pagingData)
                .then(function(response) {
                    vm.griddata = response.data.grid;
                    // Update pagination data
                    vm.pagingData.totalItems = response.data.totalItems;
                    vm.pagingData.totalPages = Math.ceil(vm.pagingData.totalItems / vm.pagingData.pageSize);
                    vm.pagingData.hasPrevPage = vm.pagingData.requestedPage > 1;
                    vm.pagingData.hasNextPage = vm.pagingData.requestedPage < vm.pagingData.totalPages;
                })
                .catch(function(error) {
                    console.error('Error fetching grid data:', error);
                });
        }

        function becomeUser(userId) {
            console.log(userId);
            $http.post('superadmin/manageusers/jxBecomeUser', { user_id: userId })
                .then(function(response) {
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error('Error becoming user:', error);
                });
        };

        activate();
    });
</script>
