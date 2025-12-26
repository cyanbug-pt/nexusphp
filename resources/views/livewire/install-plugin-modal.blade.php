<div>
    <h3 class="text-danger-700 pb-6">注意: 执行此操作会先将站点启用维护模式, 执行完毕后会关闭维护模式!</h3>
    <textarea id="output" rows="10" class="w-full border rounded p-2" readonly></textarea>
    <div class="mt-4">
        <button id="btn-run" class="fi-btn">点击执行</button>
    </div>
</div>

<script>
document.getElementById('btn-run').addEventListener('click', () => {
    document.getElementById('output').textContent = ''; // 清空之前的输出
    const es = new EventSource('/admin/sse?plugin_id=tgbot&action=install_plugin');
    const textarea = document.getElementById("output")
    es.onmessage = (event) => {
        console.log("onmessage: ", event.data)
        if (event.data === "close") {
            console.log("close es ...")
            es.close();
            return
        }
        textarea.textContent += event.data + "\n"
        textarea.scrollTop = textarea.scrollHeight
    }
    es.onerror = (event) => {
        console.log("onerror: ", event)
        switch (es.readyState) {
            case EventSource.CONNECTING:
                console.log("Reconnecting...");
                break;
            case EventSource.CLOSED:
                console.log("Connection closed.");
                break;
        }
        es.close()
    }
});


</script>
