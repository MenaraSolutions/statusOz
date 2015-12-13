var vm = new Vue({
    el: '#app',

    data: {
        currentTestSource: '',
        testSources: [
            { title: 'Average', worker: '*' },
            { title: 'from Singapore', worker: 'Singapore' },
            { title: 'from California', worker: 'California' }
        ],
        subjects: [],
        subjectGroups: []
    },

    computed: {
        // Return subjects for current test source
        testItems: function() {
            if (this.currentTestSource.worker == '*') {
                return this.subjectGroups;
            } else {
                var groups = [];

                for(var i=0; i < this.subjects.length; i++) {
                    if ($.inArray(this.currentTestSource.worker, this.subjects[i].workers) != -1) {
                        groups.push(this.subjects[i]);
                    }
                }

                return groups;
            }
        }
    },

    methods: {
        // Choose another worker source
        changeTestSource: function(testSource) {
            this.currentTestSource = testSource;
        },

        // Propose a CSS class based on subject/group status
        getStatusClass: function(testSource) {
            switch (testSource.status) {
                case 0:
                    return 'Status__ok';

                case 1:
                    return 'Status__issues';

                case 2:
                default:
                    return 'Status__faulty';
            }
        }
    },

    ready: function() {
        this.currentTestSource = this.testSources[0];
        this.subjects = globalSubjects;
        this.subjectGroups = globalSubjectGroups;
    }
});