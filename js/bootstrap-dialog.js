/* global define */

/* ================================================
 * Make use of Bootstrap's modal more monkey-friendly.
 *
 * For Bootstrap 3.
 *
 * javanoob@hotmail.com
 *
 * https://github.com/nakupanda/bootstrap3-dialog
 *
 * Licensed under The MIT License.
 * ================================================ */
(function (root, factory) {

    "use strict";

    // CommonJS module is defined
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = factory(require('jquery'), require('bootstrap'));
    }
    // AMD module is defined
    else if (typeof define === "function" && define.amd) {
        define("bootstrap-dialog", ["jquery", "bootstrap"], function ($) {
            return factory($);
        });
    } else {
        // planted over the root!
        root.BootstrapDialog = factory(root.jQuery);
    }

}(this, function ($) {

    "use strict";

    /* ================================================
     * Definition of BootstrapDialogModal.
     * Extend Bootstrap Modal and override some functions.
     * BootstrapDialogModal === Modified Modal.
     * ================================================ */
    var Modal = $.fn.modal.Constructor;
    var BootstrapDialogModal = function (element, options) {
        Modal.call(this, element, options);
    };
    BootstrapDialogModal.getModalVersion = function () {
        var version = null;
        if (typeof $.fn.modal.Constructor.VERSION === 'undefined') {
            version = 'v3.1';
        } else if (/3\.2\.\d+/.test($.fn.modal.Constructor.VERSION)) {
            version = 'v3.2';
        } else if (/3\.3\.[1,2]/.test($.fn.modal.Constructor.VERSION)) {
            version = 'v3.3';  // v3.3.1, v3.3.2
        } else {
            version = 'v3.3.4';
        }

        return version;
    };
    BootstrapDialogModal.ORIGINAL_BODY_PADDING = parseInt(($('body').css('padding-right') || 0), 10);
    BootstrapDialogModal.METHODS_TO_OVERRIDE = {};
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.1'] = {};
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.2'] = {
        hide: function (e) {
            if (e) {
                e.preventDefault();
            }
            e = $.Event('hide.bs.modal');

            this.$element.trigger(e);

            if (!this.isShown || e.isDefaultPrevented()) {
                return;
            }

            this.isShown = false;

            // Remove css class 'modal-open' when the last opened dialog is closing.
            var openedDialogs = this.getGlobalOpenedDialogs();
            if (openedDialogs.length === 0) {
                this.$body.removeClass('modal-open');
            }

            this.resetScrollbar();
            this.escape();

            $(document).off('focusin.bs.modal');

            this.$element
            .removeClass('in')
            .attr('aria-hidden', true)
            .off('click.dismiss.bs.modal');

            $.support.transition && this.$element.hasClass('fade') ?
            this.$element
            .one('bsTransitionEnd', $.proxy(this.hideModal, this))
            .emulateTransitionEnd(300) :
            this.hideModal();
        }
    };
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.3'] = {
        /**
         * Overrided.
         * 
         * @returns {undefined}
         */
        setScrollbar: function () {
            var bodyPad = BootstrapDialogModal.ORIGINAL_BODY_PADDING;
            if (this.bodyIsOverflowing) {
                this.$body.css('padding-right', bodyPad + this.scrollbarWidth);
            }
        },
        /**
         * Overrided.
         * 
         * @returns {undefined}
         */
        resetScrollbar: function () {
            var openedDialogs = this.getGlobalOpenedDialogs();
            if (openedDialogs.length === 0) {
                this.$body.css('padding-right', BootstrapDialogModal.ORIGINAL_BODY_PADDING);
            }
        },
        /**
         * Overrided.
         * 
         * @returns {undefined}
         */
        hideModal: function () {
            this.$element.hide();
            this.backdrop($.proxy(function () {
                var openedDialogs = this.getGlobalOpenedDialogs();
                if (openedDialogs.length === 0) {
                    this.$body.removeClass('modal-open');
                }
                this.resetAdjustments();
                this.resetScrollbar();
                this.$element.trigger('hidden.bs.modal');
            }, this));
        }
    };
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.3.4'] = $.extend({}, BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.3']);
    BootstrapDialogModal.prototype = {
        constructor: BootstrapDialogModal,
        /**
         * New function, to get the dialogs that opened by BootstrapDialog.
         * 
         * @returns {undefined}
         */
        getGlobalOpenedDialogs: function () {
            var openedDialogs = [];
            $.each(BootstrapDialog.dialogs, function (id, dialogInstance) {
                if (dialogInstance.isRealized() && dialogInstance.isOpened()) {
                    openedDialogs.push(dialogInstance);
                }
            });

            return openedDialogs;
        }
    };

    // Add compatible methods.
    BootstrapDialogModal.prototype = $.extend(BootstrapDialogModal.prototype, Modal.prototype, BootstrapDialogModal.METHODS_TO_OVERRIDE[BootstrapDialogModal.getModalVersion()]);

    /* ================================================
     * Definition of BootstrapDialog.
     * ================================================ */
    var BootstrapDialog = function (options) {
        this.defaultOptions = $.extend(true, {
            id: BootstrapDialog.newGuid(),
            buttons: [],
            data: {},
            onshow: null,
            onshown: null,
            onhide: null,
            onhidden: null
        }, BootstrapDialog.defaultOptions);
        this.indexedButtons = {};
        this.registeredButtonHotkeys = {};
        this.draggableData = {
            isMouseDown: false,
            mouseOffset: {}
        };
        this.realized = false;
        this.opened = false;
        this.initOptions(options);
        this.holdThisInstance();
    };

    BootstrapDialog.BootstrapDialogModal = BootstrapDialogModal;

    /**
     *  Some constants.
     */
    BootstrapDialog.NAMESPACE = 'bootstrap-dialog';
    BootstrapDialog.TYPE_DEFAULT = 'type-default';
    BootstrapDialog.TYPE_INFO = 'type-info';
    BootstrapDialog.TYPE_PRIMARY = 'type-primary';
    BootstrapDialog.TYPE_SUCCESS = 'type-success';
    BootstrapDialog.TYPE_WARNING = 'type-warning';
    BootstrapDialog.TYPE_DANGER = 'type-danger';
    BootstrapDialog.DEFAULT_TEXTS = {};
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DEFAULT] = 'Information';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_INFO] = 'Information';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_PRIMARY] = 'Information';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_SUCCESS] = 'Success';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_WARNING] = 'Warning';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DANGER] = 'Danger';
    BootstrapDialog.DEFAULT_TEXTS['OK'] = 'OK';
    BootstrapDialog.DEFAULT_TEXTS['CANCEL'] = 'Cancel';
    BootstrapDialog.DEFAULT_TEXTS['CONFIRM'] = 'Confirmation';
    BootstrapDialog.SIZE_NORMAL = 'size-normal';
    BootstrapDialog.SIZE_SMALL = 'size-small';
    BootstrapDialog.SIZE_WIDE = 'size-wide';    // size-wide is equal to modal-lg
    BootstrapDialog.SIZE_LARGE = 'size-large';
    BootstrapDialog.BUTTON_SIZES = {};
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_NORMAL] = '';
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_SMALL] = '';
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_WIDE] = '';
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_LARGE] = 'btn-lg';
    BootstrapDialog.ICON_SPINNER = 'glyphicon glyphicon-asterisk';

    /**
     * Default options.
     */
    BootstrapDialog.defaultOptions = {
        type: BootstrapDialog.TYPE_PRIMARY,
        size: BootstrapDialog.SIZE_NORMAL,
        cssClass: '',
        title: null,
        message: null,
        nl2br: true,
        closable: true,
        closeByBackdrop: true,
        closeByKeyboard: true,
        closeIcon: '&#215;',
        spinicon: BootstrapDialog.ICON_SPINNER,
        autodestroy: true,
        draggable: false,
        animate: true,
        description: '',
        tabindex: -1
    };

    /**
     * Config default options.
     */
    BootstrapDialog.configDefaultOptions = function (options) {
        BootstrapDialog.defaultOptions = $.extend(true, BootstrapDialog.defaultOptions, options);
    };

    /**
     * Open / Close all created dialogs all at once.
     */
    BootstrapDialog.dialogs = {};
    BootstrapDialog.openAll = function () {
        $.each(BootstrapDialog.dialogs, function (id, dialogInstance) {
            dialogInstance.open();
        });
    };
    BootstrapDialog.closeAll = function () {
        $.each(BootstrapDialog.dialogs, function (id, dialogInstance) {
            dialogInstance.close();
        });
    };

    /**
     * Get dialog instance by given id.
     * 
     * @returns dialog instance
     */
    BootstrapDialog.getDialog = function (id) {
        var dialog = null;
        if (typeof BootstrapDialog.dialogs[id] !== 'undefined') {
            dialog = BootstrapDialog.dialogs[id];
        }

        return dialog;
    };

    /**
     * Set a dialog.
     * 
     * @returns the dialog that has just been set.
     */
    BootstrapDialog.setDialog = function (dialog) {
        BootstrapDialog.dialogs[dialog.getId()] = dialog;

        return dialog;
    };

    /**
     * Alias of BootstrapDialog.setDialog(dialog)
     * 
     * @param {type} dialog
     * @returns {unresolved}
     */
    BootstrapDialog.addDialog = function (dialog) {
        return BootstrapDialog.setDialog(dialog);
    };

    /**
     * Move focus to next visible dialog.
     */
    BootstrapDialog.moveFocus = function () {
        var lastDialogInstance = null;
        $.each(BootstrapDialog.dialogs, function (id, dialogInstance) {
            if (dialogInstance.isRealized() && dialogInstance.isOpened()) {
                lastDialogInstance = dialogInstance;
            }
        });
        if (lastDialogInstance !== null) {
            lastDialogInstance.getModal().focus();
        }
    };

    BootstrapDialog.METHODS_TO_OVERRIDE = {};
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.1'] = {
        handleModalBackdropEvent: function () {
            this.getModal().on('click', {dialog: this}, function (event) {
                event.target === this && event.data.dialog.isClosable() && event.data.dialog.canCloseByBackdrop() && event.data.dialog.close();
            });

            return this;
        },
        /**
         * To make multiple opened dialogs look better.
         * 
         * Will be removed in later version, after Bootstrap Modal >= 3.3.0, updating z-index is unnecessary.
         */
        updateZIndex: function () {
            if (this.isOpened()) {
                var zIndexBackdrop = 1040;
                var zIndexModal = 1050;
                var dialogCount = 0;
                $.each(BootstrapDialog.dialogs, function (dialogId, dialogInstance) {
                    if (dialogInstance.isRealized() && dialogInstance.isOpened()) {
                        dialogCount++;
                    }
                });
                var $modal = this.getModal();
                var $backdrop = $modal.data('bs.modal').$backdrop;
                $modal.css('z-index', zIndexModal + (dialogCount - 1) * 20);
                $backdrop.css('z-index', zIndexBackdrop + (dialogCount - 1) * 20);
            }

            return this;
        },
        open: function () {
            !this.isRealized() && this.realize();
            this.getModal().modal('show');
            this.updateZIndex();

            return this;
        }
    };
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.2'] = {
        handleModalBackdropEvent: BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']['handleModalBackdropEvent'],
        updateZIndex: BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']['updateZIndex'],
        open: BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']['open']
    };
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.3'] = {};
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.3.4'] = $.extend({}, BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']);
    BootstrapDialog.prototype = {
        constructor: BootstrapDialog,
        initOptions: function (options) {
            this.options = $.extend(true, this.defaultOptions, options);

            return this;
        },
        holdThisInstance: function () {
            BootstrapDialog.addDialog(this);

            return this;
        },
        initModalStuff: function () {
            this.setModal(this.createModal())
            .setModalDialog(this.createModalDialog())
            .setModalContent(this.createModalContent())
            .setModalHeader(this.createModalHeader())
            .setModalBody(this.createModalBody())
            .setModalFooter(this.createModalFooter());

            this.getModal().append(this.getModalDialog());
            this.getModalDialog().append(this.getModalContent());
            this.getModalContent()
            .append(this.getModalHeader())
            .append(this.getModalBody())
            .append(this.getModalFooter());

            return this;
        },
        createModal: function () {
            var $modal = $('<div class="modal" role="dialog" aria-hidden="true"></div>');
            $modal.prop('id', this.getId());
            $modal.attr('aria-labelledby', this.getId() + '_title');

            return $modal;
        },
        getModal: function () {
            return this.$modal;
        },
        setModal: function ($modal) {
            this.$modal = $modal;

            return this;
        },
        createModalDialog: function () {
            return $('<div class="modal-dialog"></div>');
        },
        getModalDialog: function () {
            return this.$modalDialog;
        },
        setModalDialog: function ($modalDialog) {
            this.$modalDialog = $modalDialog;

            return this;
        },
        createModalContent: function () {
            return $('<div class="modal-content"></div>');
        },
        getModalContent: function () {
            return this.$modalContent;
        },
        setModalContent: function ($modalContent) {
            this.$modalContent = $modalContent;

            return this;
        },
        createModalHeader: function () {
            return $('<div class="modal-header"></div>');
        },
        getModalHeader: function () {
            return this.$modalHeader;
        },
        setModalHeader: function ($modalHeader) {
            this.$modalHeader = $modalHeader;

            return this;
        },
        createModalBody: function () {
            return $('<div class="modal-body"></div>');
        },
        getModalBody: function () {
            return this.$modalBody;
        },
        setModalBody: function ($modalBody) {
            this.$modalBody = $modalBody;

            return this;
        },
        createModalFooter: function () {
            return $('<div class="modal-footer"></div>');
        },
        getModalFooter: function () {
            return this.$modalFooter;
        },
        setModalFooter: function ($modalFooter) {
            this.$modalFooter = $modalFooter;

            return this;
        },
        createDynamicContent: function (rawContent) {
            var content = null;
            if (typeof rawContent === 'function') {
                content = rawContent.call(rawContent, this);
            } else {
                content = rawContent;
            }
            if (typeof content === 'string') {
                content = this.formatStringContent(content);
            }

            return content;
        },
        formatStringContent: function (content) {
            if (this.options.nl2br) {
                return content.replace(/\r\n/g, '<br />').replace(/[\r\n]/g, '<br />');
            }

            return content;
        },
        setData: function (key, value) {
            this.options.data[key] = value;

            return this;
        },
        getData: function (key) {
            return this.options.data[key];
        },
        setId: function (id) {
            this.options.id = id;

            return this;
        },
        getId: function () {
            return this.options.id;
        },
        getType: function () {
            return this.options.type;
        },
        setType: function (type) {
            this.options.type = type;
            this.updateType();

            return this;
        },
        updateType: function () {
            if (this.isRealized()) {
                var types = [BootstrapDialog.TYPE_DEFAULT,
                    BootstrapDialog.TYPE_INFO,
                    BootstrapDialog.TYPE_PRIMARY,
                    BootstrapDialog.TYPE_SUCCESS,
                    BootstrapDialog.TYPE_WARNING,
                    BootstrapDialog.TYPE_DANGER];

                this.getModal().removeClass(types.join(' ')).addClass(this.getType());
            }

            return this;
        },
        getSize: function () {
            return this.options.size;
        },
        setSize: function (size) {
            this.options.size = size;
            this.updateSize();

            return this;
        },
        updateSize: function () {
            if (this.isRealized()) {
                var dialog = this;

                // Dialog size
                this.getModal().removeClass(BootstrapDialog.SIZE_NORMAL)
                .removeClass(BootstrapDialog.SIZE_SMALL)
                .removeClass(BootstrapDialog.SIZE_WIDE)
                .removeClass(BootstrapDialog.SIZE_LARGE);
                this.getModal().addClass(this.getSize());

                // Smaller dialog.
                this.getModalDialog().removeClass('modal-sm');
                if (this.getSize() === BootstrapDialog.SIZE_SMALL) {
                    this.getModalDialog().addClass('modal-sm');
                }

                // Wider dialog.
                this.getModalDialog().removeClass('modal-lg');
                if (this.getSize() === BootstrapDialog.SIZE_WIDE) {
                    this.getModalDialog().addClass('modal-lg');
                }

                // Button size
                $.each(this.options.buttons, function (index, button) {
                    var $button = dialog.getButton(button.id);
                    var buttonSizes = ['btn-lg', 'btn-sm', 'btn-xs'];
                    var sizeClassSpecified = false;
                    if (typeof button['cssClass'] === 'string') {
                        var btnClasses = button['cssClass'].split(' ');
                        $.each(btnClasses, function (index, btnClass) {
                            if ($.inArray(btnClass, buttonSizes) !== -1) {
                                sizeClassSpecified = true;
                            }
                        });
                    }
                    if (!sizeClassSpecified) {
                        $button.removeClass(buttonSizes.join(' '));
                        $button.addClass(dialog.getButtonSize());
                    }
                });
            }

            return this;
        },
        getCssClass: function () {
            return this.options.cssClass;
        },
        setCssClass: function (cssClass) {
            this.options.cssClass = cssClass;

            return this;
