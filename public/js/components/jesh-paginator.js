
app.directive('jeshPaginator', function() {
    return {
        restrict: 'E',
        scope: {
            pagingData: '=',
            functionCall: '&'
        },
        templateUrl: '/js/components/jesh-paginator.html',
        link: function(scope) {
            scope.pages = [];

            scope.$watch('pagingData', function(newVal) {
                if (newVal) {
                    scope.pages = Array.from({ length: newVal.totalPages }, (_, i) => i + 1);
                }
            }, true);
            scope.pagingData.currentPage = 1;
            scope.changePage = function(page) {
                if (page >= 1 && page <= scope.pagingData.totalPages) {
                    scope.pagingData.requestedPage = page;
                    scope.pagingData.currentPage = page;
                    scope.functionCall();
                }
            };
        }
    };
});
