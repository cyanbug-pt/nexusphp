const Passkey = (() => {
    const apiUrl = '/ajax.php';

    const supported = () => {
        return window.PublicKeyCredential;
    }

    const conditionalSupported = () => {
        return supported() && PublicKeyCredential.isConditionalMediationAvailable;
    }

    const isCMA = async () => {
        return await PublicKeyCredential.isConditionalMediationAvailable();
    }

    const getCreateArgs = async () => {
        const getArgsParams = new URLSearchParams();
        getArgsParams.set('action', 'getPasskeyCreateArgs');

        const response = await fetch(apiUrl, {
            method: 'POST',
            body: getArgsParams,
        });
        const data = await response.json();
        if (data.ret !== 0) {
            throw new Error(data.msg);
        }

        const createArgs = data.data;
        recursiveBase64StrToArrayBuffer(createArgs);
        return createArgs;
    }

    const createRegistration = async () => {
        const createArgs = await getCreateArgs();

        const cred = await navigator.credentials.create(createArgs);

        const processCreateParams = new URLSearchParams();
        processCreateParams.set('action', 'processPasskeyCreate');
        processCreateParams.set('params[transports]', cred.response.getTransports ? cred.response.getTransports() : null)
        processCreateParams.set('params[clientDataJSON]', cred.response.clientDataJSON ? arrayBufferToBase64(cred.response.clientDataJSON) : null);
        processCreateParams.set('params[attestationObject]', cred.response.attestationObject ? arrayBufferToBase64(cred.response.attestationObject) : null);

        const response = await fetch(apiUrl, {
            method: 'POST',
            body: processCreateParams,
        });
        const data = await response.json();
        if (data.ret !== 0) {
            throw new Error(data.msg);
        }
    }

    const getGetArgs = async () => {
        const getArgsParams = new URLSearchParams();
        getArgsParams.set('action', 'getPasskeyGetArgs');

        const response = await fetch(apiUrl, {
            method: 'POST',
            body: getArgsParams,
        });
        const data = await response.json();
        if (data.ret !== 0) {
            throw new Error(data.msg);
        }

        const getArgs = data.data;
        recursiveBase64StrToArrayBuffer(getArgs);
        return getArgs;
    }

    let abortController;

    const checkRegistration = async (conditional, showLoading) => {
        if (abortController) {
            abortController.abort()
            abortController = null;
        }
        if (!conditional) showLoading();
        const getArgs = await getGetArgs();
        if (conditional) {
            abortController = new AbortController();
            getArgs.signal = abortController.signal;
            getArgs.mediation = 'conditional';
        }

        const cred = await navigator.credentials.get(getArgs);

        if (conditional) showLoading();

        const processGetParams = new URLSearchParams();
        processGetParams.set('action', 'processPasskeyGet');
        processGetParams.set('params[challenge]', arrayBufferToBase64(getArgs['publicKey']['challenge']));
        processGetParams.set('params[id]', cred.rawId ? arrayBufferToBase64(cred.rawId) : null);
        processGetParams.set('params[clientDataJSON]', cred.response.clientDataJSON ? arrayBufferToBase64(cred.response.clientDataJSON) : null);
        processGetParams.set('params[authenticatorData]', cred.response.authenticatorData ? arrayBufferToBase64(cred.response.authenticatorData) : null);
        processGetParams.set('params[signature]', cred.response.signature ? arrayBufferToBase64(cred.response.signature) : null);
        processGetParams.set('params[userHandle]', cred.response.userHandle ? arrayBufferToBase64(cred.response.userHandle) : null);

        const response = await fetch(apiUrl, {
            method: 'POST',
            body: processGetParams,
        });
        const data = await response.json();
        if (data.ret !== 0) {
            throw new Error(data.msg);
        }
    }

    const deleteRegistration = async (credentialId) => {
        const deleteParams = new URLSearchParams();
        deleteParams.set('action', 'deletePasskey');
        deleteParams.set('params[credentialId]', credentialId);

        const response = await fetch(apiUrl, {
            method: 'POST',
            body: deleteParams,
        });
        const data = await response.json();
        if (data.ret !== 0) {
            throw new Error(data.msg);
        }
    }

    const recursiveBase64StrToArrayBuffer = (obj) => {
        let prefix = '=?BINARY?B?';
        let suffix = '?=';
        if (typeof obj === 'object') {
            for (let key in obj) {
                if (typeof obj[key] === 'string') {
                    let str = obj[key];
                    if (str.substring(0, prefix.length) === prefix && str.substring(str.length - suffix.length) === suffix) {
                        str = str.substring(prefix.length, str.length - suffix.length);

                        let binary_string = window.atob(str);
                        let len = binary_string.length;
                        let bytes = new Uint8Array(len);
                        for (let i = 0; i < len; i++) {
                            bytes[i] = binary_string.charCodeAt(i);
                        }
                        obj[key] = bytes.buffer;
                    }
                } else {
                    recursiveBase64StrToArrayBuffer(obj[key]);
                }
            }
        }
    }

    const arrayBufferToBase64 = (buffer) => {
        let binary = '';
        let bytes = new Uint8Array(buffer);
        let len = bytes.byteLength;
        for (let i = 0; i < len; i++) {
            binary += String.fromCharCode(bytes[i]);
        }
        return window.btoa(binary);
    }

    return {
        supported: supported,
        conditionalSupported: conditionalSupported,
        createRegistration: createRegistration,
        checkRegistration: checkRegistration,
        deleteRegistration: deleteRegistration,
        isCMA: isCMA,
    }
})();
