<div class="pagination-container">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item" ng-class="{'disabled': !pagingData.hasPrevPage}">
                <a class="page-link" href="#" ng-click="changePage(pagingData.currentPage - 1)">Previous</a>
            </li>
            <li class="page-item" ng-repeat="page in pages" ng-class="{'active': page === pagingData.currentPage}">
                <a class="page-link" href="#" ng-click="changePage(page)">@{{ page }}</a>
            </li>
            <li class="page-item" ng-class="{'disabled': !pagingData.hasNextPage}">
                <a class="page-link" href="#" ng-click="changePage(pagingData.currentPage + 1)">Next</a>
            </li>
        </ul>
    </nav>
</div>
