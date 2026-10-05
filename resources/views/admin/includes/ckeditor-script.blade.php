<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
<script>
    (function () {
        const uploadUrl = "{{ route('admin.editor.upload') }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || "{{ csrf_token() }}";

        const editorConfig = {
            toolbar: {
                items: [
                    'sourceEditing', '|',
                    'heading', '|',
                    'fontSize', 'bold', 'italic', 'underline', 'strikethrough', 'alignment', '|',
                    'numberedList', 'bulletedList', '|',
                    'outdent', 'indent', '|',
                    'link', 'uploadImage', 'insertTable', 'mediaEmbed'
                ],
                shouldNotGroupWhenFull: true
            },
            simpleUpload: {
                uploadUrl: uploadUrl,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            },
            mediaEmbed: {
                previewsInData: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                ]
            },
            image: {
                toolbar: [
                    'imageTextAlternative', 'toggleImageCaption', '|',
                    'imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|',
                    'linkImage'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells', 'tableCellProperties', 'tableProperties'
                ]
            },
            placeholder: 'Type or write your detailed content here...',
            removePlugins: [
                // Commercial / Premium Plugins requiring license key
                'AIAssistant',
                'CKBox',
                'CKFinder',
                'EasyImage',
                'MultiLevelList',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced',
                'CaseChange',
                'ExportPdf',
                'ExportWord',
                'ImportWord'
            ]
        };

        window.initCKEditor = function (target) {
            const elements = typeof target === 'string' ? document.querySelectorAll(target) : [target];
            elements.forEach(function (textarea) {
                if (textarea && !textarea.classList.contains('ckeditor-initialized')) {
                    CKEDITOR.ClassicEditor.create(textarea, editorConfig)
                        .then(editor => {
                            textarea.classList.add('ckeditor-initialized');
                            textarea.ckeditorInstance = editor;

                            // Two-way sync data back to textarea on every change
                            editor.model.document.on('change:data', () => {
                                textarea.value = editor.getData();
                            });

                            // Ensure data is synced on form submit
                            const form = textarea.closest('form');
                            if (form && !form.dataset.ckeditorSyncAttached) {
                                form.dataset.ckeditorSyncAttached = 'true';
                                form.addEventListener('submit', () => {
                                    document.querySelectorAll('.ckeditor-initialized').forEach(el => {
                                        if (el.ckeditorInstance) {
                                            el.value = el.ckeditorInstance.getData();
                                        }
                                    });
                                });
                            }
                        })
                        .catch(error => {
                            console.error('CKEditor initialization error:', error);
                        });
                }
            });
        };

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () {
                initCKEditor('.ckeditor-input, #description, #description_bn');
            });
        } else {
            initCKEditor('.ckeditor-input, #description, #description_bn');
        }
    })();
</script>