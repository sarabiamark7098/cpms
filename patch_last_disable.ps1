$files = @(
    'C:\laragon\www\cpms\socialwork\last.php',
    'C:\laragon\www\cpms\socialwork\socialworkupdate\last.php'
)

$jsBlock = @"

        /* disable-print-done-on-change */
        (function () {
            var form = document.querySelector('form');
            if (!form) return;
            function disablePrintDone() {
                document.querySelectorAll('[name="printa"],[name="printgis"],[name="printis"],[name="printce"],[name="print"]').forEach(function (b) {
                    b.disabled = true;
                    b.classList.remove('btn-primary');
                    b.classList.add('btn-secondary');
                });
                var done = document.getElementById('done');
                if (done) {
                    done.disabled = true;
                    done.classList.remove('btn-success');
                    done.classList.add('btn-secondary');
                }
            }
            form.addEventListener('input', disablePrintDone);
            form.addEventListener('change', disablePrintDone);
        })();
"@

$anchor = "document.body.innerHTML = oldPage;"

foreach ($f in $files) {
    $content = [System.IO.File]::ReadAllText($f)

    # Check if already patched
    if ($content.Contains('disable-print-done-on-change')) {
        Write-Host "Already patched: $f"
        continue
    }

    # Find the anchor and insert JS block before the closing </script>
    # The anchor is unique: "document.body.innerHTML = oldPage;" appears once in the script block
    $idx = $content.IndexOf($anchor)
    if ($idx -lt 0) {
        Write-Host "Anchor not found in: $f"
        continue
    }

    # Find the next </script> after the anchor
    $scriptClose = "</script>"
    $closeIdx = $content.IndexOf($scriptClose, $idx)
    if ($closeIdx -lt 0) {
        Write-Host "Closing </script> not found in: $f"
        continue
    }

    # Insert the JS block just before the </script>
    $newContent = $content.Substring(0, $closeIdx) + $jsBlock + "`r`n    " + $scriptClose + $content.Substring($closeIdx + $scriptClose.Length)
    [System.IO.File]::WriteAllText($f, $newContent, [System.Text.Encoding]::UTF8)
    Write-Host "Patched: $f"
}
